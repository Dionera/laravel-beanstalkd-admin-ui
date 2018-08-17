<?php

namespace Dionera\BeanstalkdUI\Controllers\Api;

use Illuminate\Routing\Controller;
use Pheanstalk\PheanstalkInterface;
use Dionera\BeanstalkdUI\Repositories\JobRepository;

class StatsController extends Controller
{
    /**
     * @var JobRepository
     */
    private $jobs;
    /**
     * @var PheanstalkInterface
     */
    private $pheanstalk;

    /**
     * StatsController constructor.
     *
     * @param PheanstalkInterface $pheanstalk
     * @param JobRepository       $jobs
     */
    public function __construct(PheanstalkInterface $pheanstalk, JobRepository $jobs)
    {
        $this->jobs = $jobs;
        $this->pheanstalk = $pheanstalk;
    }

    /**
     * @param $tube
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function statsForTube($tube)
    {
        try {
            $tubeStats = $this->pheanstalk->statsTube($tube);
        } catch (\Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'tube name:' => $tube]);
        }

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
