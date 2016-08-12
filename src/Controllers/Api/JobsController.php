<?php

namespace Dionera\BeanstalkdUI\Controllers\Api;

use Illuminate\Routing\Controller;
use Pheanstalk\PheanstalkInterface;

class JobsController extends Controller
{
    /**
     * @var PheanstalkInterface
     */
    private $pheanstalk;

    /**
     * JobsController constructor.
     *
     * @param PheanstalkInterface $pheanstalk
     */
    public function __construct(PheanstalkInterface $pheanstalk)
    {
        $this->pheanstalk = $pheanstalk;
    }

    /**
     * @param $job
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($job)
    {
        try {
            $instance = $this->pheanstalk->peek($job);

            $this->pheanstalk->delete($instance);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully deleted Job',
            ]);
        } catch (ServerException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param $job
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function kick($job)
    {
        try {
            $instance = $this->pheanstalk->peek($job);

            $this->pheanstalk->kickJob($instance);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully kicked job into ready state.',
            ]);
        } catch (ServerException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
