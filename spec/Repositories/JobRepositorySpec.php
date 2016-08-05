<?php

namespace spec\Dionera\BeanstalkdUI\Repositories;

use PhpSpec\ObjectBehavior;
use Pheanstalk\PheanstalkInterface;
use Pheanstalk\Job as PheanstalkJob;
use Dionera\BeanstalkdUI\Models\Job;
use Pheanstalk\Exception\ServerException;

class JobRepositorySpec extends ObjectBehavior
{
    public function let(PheanstalkInterface $pheanstalk)
    {
        $this->beConstructedWith($pheanstalk);
    }

    public function it_fetches_the_next_ready_job_from_the_tube(PheanstalkInterface $pheanstalk)
    {
        $job = new PheanstalkJob(1, 'foo');

        $pheanstalk->peekReady('default')->willReturn($job);

        $this->nextReady('default')->shouldBeLike(new Job($job));
    }

    public function it_returns_null_if_no_ready_job_exists(PheanstalkInterface $pheanstalk)
    {
        $pheanstalk->peekReady('default')->willThrow(ServerException::class);

        $this->nextReady('default')->shouldBeNull();
    }

    public function it_fetches_the_next_delayed_job_from_the_tube(PheanstalkInterface $pheanstalk)
    {
        $job = new PheanstalkJob(1, 'foo');

        $pheanstalk->peekDelayed('default')->willReturn($job);

        $this->nextDelayed('default')->shouldBeLike(new Job($job));
    }

    public function it_returns_null_if_no_delayed_job_exists(PheanstalkInterface $pheanstalk)
    {
        $pheanstalk->peekDelayed('default')->willThrow(ServerException::class);

        $this->nextDelayed('default')->shouldBeNull();
    }

    public function it_fetches_the_stats_for_a_job(PheanstalkInterface $pheanstalk)
    {
        $job = new PheanstalkJob(1, 'foo');

        $this->getStats($job);

        $pheanstalk->statsJob($job)->shouldHaveBeenCalled();
    }

    public function it_fetches_the_job_stats_as_well_as_the_job_itself(PheanstalkInterface $pheanstalk)
    {
        $job = new PheanstalkJob(1, 'foo');
        $pheanstalk->peekReady('default')->willReturn($job);

        $stats = new \stdClass();
        $stats->age = 100;
        $pheanstalk->statsJob($job)->willReturn($stats);

        $this->nextReady('default', true)->shouldBeLike(new Job($job, $stats));
    }

    public function it_fetches_the_next_buried_job(PheanstalkInterface $pheanstalk)
    {
        $job = new PheanstalkJob(1, 'foo');

        $pheanstalk->peekBuried('default')->willReturn($job);

        $this->nextBuried('default')->shouldBeLike(new Job($job));
    }
}
