<?php declare(strict_types=1);

namespace Dionera\BeanstalkdUI\Controllers\Api;

use Illuminate\Routing\Controller;
use Pheanstalk\Contract\PheanstalkInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dionera\BeanstalkdUI\Repositories\JobRepository;

class StatsController extends Controller
{
    private JobRepository $jobs;

    private PheanstalkInterface $pheanstalk;

    public function __construct(PheanstalkInterface $pheanstalk, JobRepository $jobs)
    {
        $this->jobs = $jobs;
        $this->pheanstalk = $pheanstalk;
    }

    public function statsForTube(string $tube): JsonResponse
    {
        $tubeStats = $this->pheanstalk->statsTube($tube);

        $nextReady = $this->jobs->nextReady($tube, true);
        $nextBuried = $this->jobs->nextBuried($tube);
        $nextDelayed = $this->jobs->nextDelayed($tube, true);

        return response()->json([
            'tubeStats' => $tubeStats,
            'nextReady' => $nextReady ? $nextReady->toJson() : null,
            'nextBuried' => $nextBuried ? $nextBuried->toJson() : null,
            'nextDelayed' => $nextDelayed ? $nextDelayed->toJson() : null,
        ]);
    }
}
