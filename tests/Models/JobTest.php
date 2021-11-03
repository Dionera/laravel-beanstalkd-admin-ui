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
    expect($this->job)->getId()->toBe(1);
});

it("provides access to the underlying job's data", function () {
    expect($this->job)->getData()->toBe('::data::');
});

it("provides access to the underlying job's stats", function (string $stat, int $expected) {
    expect($this->job)->getStat($stat)->toBe($expected);
})->with([
    ['age', 300],
    ['time-left', 120],
]);

it('is jsonable', function () {
    expect($this->job)->toJson()->toEqual([
        'id' => 1,
        'data' => '::data::',
        'stats' => new ArrayResponse('OK', [
            'age' => 300,
            'time-left' => 120,
        ]),
    ]);
});
