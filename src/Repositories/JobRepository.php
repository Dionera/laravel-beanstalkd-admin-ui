<?php declare(strict_types=1);

namespace Dionera\BeanstalkdUI\Repositories;

use Dionera\BeanstalkdUI\Models\Job;
use Pheanstalk\Job as PheanstalkJob;
use Pheanstalk\Exception\ServerException;
use Pheanstalk\Contract\ResponseInterface;
use Pheanstalk\Contract\PheanstalkInterface;

class JobRepository
{
    private PheanstalkInterface $pheanstalk;

    public function __construct(PheanstalkInterface $pheanstalk)
    {
        $this->pheanstalk = $pheanstalk;
    }

    public function nextReady(string $tube, bool $withStats = false): ?Job
    {
        return $this->next(PheanstalkJob::STATUS_READY, $tube, $withStats);
    }

    public function nextDelayed(string $tube, bool $withStats = false): ?Job
    {
        return $this->next(PheanstalkJob::STATUS_DELAYED, $tube, $withStats);
    }

    public function nextBuried(string $tube, bool $withStats = false): ?Job
    {
        return $this->next(PheanstalkJob::STATUS_BURIED, $tube, $withStats);
    }

    public function getStats(PheanstalkJob $instance): ResponseInterface
    {
        return $this->pheanstalk->statsJob($instance);
    }

    private function next(string $type, string $tube, bool $withStats = false): ?Job
    {
        try {
            $method = 'peek' . ucfirst($type);

            $instance = $this->pheanstalk
                ->useTube($tube)
                ->{$method}($tube);

            if ($instance === null) {
                return null;
            }

            if ($withStats) {
                return new Job($instance, $this->getStats($instance));
            }

            return new Job($instance);
        } catch (ServerException $e) {
            //
        }
    }
}
