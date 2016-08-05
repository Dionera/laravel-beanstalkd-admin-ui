<?php

namespace Dionera\BeanstalkdUI\Models;

use Pheanstalk\Job as PheanstalkJob;

class Job
{
    /**
     * @var PheanstalkJob
     */
    private $job;

    /**
     * @var object
     */
    private $stats;

    /**
     * Job constructor.
     *
     * @param PheanstalkJob $job
     * @param object        $stats
     */
    public function __construct(PheanstalkJob $job, $stats = null)
    {
        $this->job = $job;
        $this->stats = $stats;
    }

    /**
     * Returns the underlying job's id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->job->getId();
    }

    /**
     * Returns the underlying job's data.
     *
     * @return string
     */
    public function getData()
    {
        return $this->job->getData();
    }

    /**
     * Returns a specific stat for the underlying job.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getStat($name)
    {
        return array_get($this->stats, $name);
    }
}
