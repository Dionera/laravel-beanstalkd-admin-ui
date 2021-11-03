<?php declare(strict_types=1);

use Mockery as m;
use Dionera\BeanstalkdUI\Models\Job;
use Pheanstalk\Job as PheanstalkJob;
use Pheanstalk\Response\ArrayResponse;
use Pheanstalk\Contract\PheanstalkInterface;
use Dionera\BeanstalkdUI\Repositories\JobRepository;

beforeEach(function () {
    $this->mockPheanstalk = m::mock(PheanstalkInterface::class);
    $this->repository = new JobRepository($this->mockPheanstalk);
});

it('fetches the next ready job from the tube', function () {
    $job = new PheanstalkJob(1, '::data::');
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peekReady')->andReturns($job);

    expect($this->repository)
        ->nextReady('::tube::')
        ->toEqual(new Job($job));
});

it('returns null if no ready job exists', function () {
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peekReady')->andReturns(null);

    expect($this->repository)
        ->nextReady('::tube::')
        ->toBeNull();
});

it('fetches the next delayed job from the tube', function () {
    $job = new PheanstalkJob(1, '::data::');
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peekDelayed')->andReturns($job);

    expect($this->repository)
        ->nextDelayed('::tube::')
        ->toEqual(new Job($job));
});

it('returns null if no delayed job exists', function () {
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peekDelayed')->andReturns(null);

    expect($this->repository)
        ->nextDelayed('::tube::')
        ->toBeNull();
});

it('fetches the stats for a tube', function () {
    $job = new PheanstalkJob(1, '::data::');
    $expectedResponse = new ArrayResponse('::name::', ['age' => 300, 'time-left' => 120]);
    $this->mockPheanstalk
        ->allows('statsJob')
        ->with($job)
        ->andReturns($expectedResponse);

    expect($this->repository)
        ->getStats($job)
        ->toEqual($expectedResponse);
});

it('fetches the job as well as the job stats', function (string $method) {
    $job = new PheanstalkJob(1, '::data::');
    $stats = new ArrayResponse('::name::', []);
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peek' . $method)->andReturns($job);
    $this->mockPheanstalk->allows('statsJob')->with($job)->andReturns($stats);

    $method = 'next' . $method;
    expect($this->repository)
        ->{$method}('::tube::', true)
        ->toEqual(new Job($job, $stats));
})->with([
    ['Ready'],
    ['Delayed'],
    ['Buried'],
]);
