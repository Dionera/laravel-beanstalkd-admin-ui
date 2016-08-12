<?php

namespace Dionera\BeanstalkdUI\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FailedJobsController extends Controller
{
    /**
     * Returns a listing of all failed jobs for a tube.
     *
     * @param $tube
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($tube)
    {
        $jobs = DB::table(config('beanstalkd.failed_jobs_table'))
            ->where('queue', $tube)
            ->get();

        return response()->json($jobs);
    }
}
