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

    $this->assertEquals(new Job($job), $this->repository->nextReady('::tube::'));
});

it('returns null if no ready job exists', function () {
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peekReady')->andReturns(null);

    $this->assertNull($this->repository->nextReady('::tube::'));
});

it('fetches the next delayed job from the tube', function () {
    $job = new PheanstalkJob(1, '::data::');
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peekDelayed')->andReturns($job);

    $this->assertEquals(new Job($job), $this->repository->nextDelayed('::tube::'));
});

it('returns null if no delayed job exists', function () {
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peekDelayed')->andReturns(null);

    $this->assertNull($this->repository->nextDelayed('::tube::'));
});

it('fetches the stats for a tube', function () {
    $job = new PheanstalkJob(1, '::data::');
    $expectedResponse = new ArrayResponse('::name::', ['age' => 300, 'time-left' => 120]);
    $this->mockPheanstalk
        ->allows('statsJob')
        ->with($job)
        ->andReturns($expectedResponse);

    $this->assertEquals($expectedResponse, $this->repository->getStats($job));
});

it('fetches the job as well as the job stats', function (string $method) {
    $job = new PheanstalkJob(1, '::data::');
    $stats = new ArrayResponse('::name::', []);
    $this->mockPheanstalk->expects('useTube')->with('::tube::')->once()->andReturnSelf();
    $this->mockPheanstalk->allows('peek' . $method)->andReturns($job);
    $this->mockPheanstalk->allows('statsJob')->with($job)->andReturns($stats);

    $method = 'next' . $method;
    $this->assertEquals(new Job($job, $stats), $this->repository->{$method}('::tube::', true));
})->with([
    ['Ready'],
    ['Delayed'],
    ['Buried'],
]);
