<?php

namespace spec\Sassnowski\BeanstalkdUI\Models;

use Pheanstalk\Response\ArrayResponse;
use PhpSpec\ObjectBehavior;
use Pheanstalk\Job as PheanstalkJob;

class JobSpec extends ObjectBehavior
{
    public function let()
    {
        $stats = new ArrayResponse('OK', [
            'age' => 300,
            'time-left' => 120,
        ]);

        $this->beConstructedWith(new PheanstalkJob(1, 'data'), $stats);
    }

    public function it_provides_access_to_the_underlying_job_id()
    {
        $this->getId()->shouldEqual(1);
    }

    public function it_provides_access_to_the_underlying_jobs_data()
    {
        $this->getData()->shouldEqual('data');
    }

    public function it_provides_access_to_the_underlying_jobs_stats()
    {
        $this->getStat('age')->shouldEqual(300);
        $this->getStat('time-left')->shouldEqual(120);
    }

    public function it_returns_null_if_the_job_has_no_stats()
    {
        $this->beConstructedWith(new PheanstalkJob(1, 'data'));

        $this->getStat('age')->shouldBeNull();
    }
}
