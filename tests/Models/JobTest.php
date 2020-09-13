<?php declare(strict_types=1);

use Dionera\BeanstalkdUI\Models\Job;
use Pheanstalk\Job as PheanstalkJob;
use Pheanstalk\Response\ArrayResponse;

beforeEach(function () {
    $this->job = new Job(
        new PheanstalkJob(1, '::data::'),
        new ArrayResponse('OK', [
            'age' => 300,
            'time-left' => 120,
        ])
    );
});

it('provides access to the underlying job id', function () {
    $this->assertEquals(1, $this->job->getId());
});

it("provides access to the underlying job's data", function () {
    $this->assertEquals('::data::', $this->job->getData());
});

it("provides access to the underlying job's stats", function (string $stat, int $expected) {
    $this->assertEquals($expected, $this->job->getStat($stat));
})->with([
    ['age', 300],
    ['time-left', 120],
]);

it('is jsonable', function () {
    $this->assertEquals([
        'id' => 1,
        'data' => '::data::',
        'stats' => new ArrayResponse('OK', [
            'age' => 300,
            'time-left' => 120,
        ]),
    ], $this->job->toJson());
});
