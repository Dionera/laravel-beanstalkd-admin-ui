<?php

namespace Sassnowski\BeanstalkdUI\Repositories;

use Pheanstalk\PheanstalkInterface;
use Pheanstalk\Job as PheanstalkJob;
use Sassnowski\BeanstalkdUI\Models\Job;
use Pheanstalk\Exception\ServerException;

class JobRepository
{
    /**
     * @var PheanstalkInterface
     */
    private $pheanstalk;

    /**
     * JobRepository constructor.
     *
     * @param PheanstalkInterface $pheanstalk
     */
    public function __construct(PheanstalkInterface $pheanstalk)
    {
        $this->pheanstalk = $pheanstalk;
    }

    /**
     * Fetches the next job with a `ready` state.
     *
     * @param string $tube
     * @param bool   $withStats
     *
     * @return null|Job Returns null if no Job with a `ready` state exists.
     */
    public function nextReady($tube, $withStats = false)
    {
        return $this->next(PheanstalkJob::STATUS_READY, $tube, $withStats);
    }

    /**
     * Returns the next delayed job from the tube.
     *
     * @param string $tube
     * @param bool   $withStats
     *
     * @return null|Job Returns null if no delayed jobs exist.
     */
    public function nextDelayed($tube, $withStats = false)
    {
        return $this->next(PheanstalkJob::STATUS_DELAYED, $tube, $withStats);
    }

    /**
     * Returns the next buried job from the tube.
     *
     * @param string $tube
     * @param bool   $withStats
     *
     * @return null|Job Returns null if no buried jobs exist.
     */
    public function nextBuried($tube, $withStats = false)
    {
        return $this->next(PheanstalkJob::STATUS_BURIED, $tube, $withStats);
    }

    /**
     * @param PheanstalkJob $instance
     *
     * @return object
     */
    public function getStats(PheanstalkJob $instance)
    {
        return $this->pheanstalk->statsJob($instance);
    }

    /**
     * Returns the next job of a given type from the tube.
     *
     * @param string $type
     * @param string $tube
     * @param bool   $withStats
     *
     * @return Job|null Returns null if no job of the given type exists.
     */
    private function next($type, $tube, $withStats = false)
    {
        try {
            $method = 'peek'.ucfirst($type);

            $instance = $this->pheanstalk->{$method}($tube);

            if ($withStats) {
                return new Job($instance, $this->getStats($instance));
            }

            return new Job($instance);
        } catch (ServerException $e) {
            //
        }
    }
}
