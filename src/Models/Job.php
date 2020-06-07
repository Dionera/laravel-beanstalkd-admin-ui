<?php declare(strict_types=1);

namespace Dionera\BeanstalkdUI\Models;

use Illuminate\Support\Arr;
use Pheanstalk\Job as PheanstalkJob;
use Illuminate\Contracts\Support\Jsonable;
use Pheanstalk\Contract\ResponseInterface;

class Job implements Jsonable
{
    private PheanstalkJob $job;
    private ?ResponseInterface $stats;

    public function __construct(PheanstalkJob $job, ?ResponseInterface $stats = null)
    {
        $this->job = $job;
        $this->stats = $stats;
    }

    public function getId(): int
    {
        return $this->job->getId();
    }

    public function getData(): string
    {
        return $this->job->getData();
    }

    public function getStat(string $name)
    {
        return Arr::get($this->stats, $name);
    }

    public function toJson($options = 0)
    {
        return [
            'id' => $this->job->getId(),
            'data' => $this->job->getData(),
            'stats' => $this->stats,
        ];
    }
}
