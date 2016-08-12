<?php

namespace Dionera\BeanstalkdUI\Controllers\Api;

use DB;
use Artisan;
use Illuminate\Routing\Controller;

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
        $jobs = DB::table(config('beanstalkdui.failed_jobs_table'))
            ->where('queue', $tube)
            ->get();

        return response()->json($jobs);
    }

    /**
     * @param string $tube
     * @param int    $failed
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forget($tube, $failed)
    {
        Artisan::call('queue:forget', [
            'id' => $failed,
        ]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * @param $tube
     * @param $failed
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function retry($tube, $failed)
    {
        Artisan::call('queue:retry', [
            'id' => [$failed],
        ]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * @param $tube
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function flush($tube)
    {
        $rows = DB::table(config('beanstalkdui.failed_jobs_table'))
            ->select('id')
            ->where('queue', $tube)
            ->get();

        // The reason we're using queue:forget here instead of queue:flush is,
        // that we only want to flush the jobs for the current queue. queue:flush
        // would simply empty the entire table.
        collect($rows)->each(function ($row) {
            Artisan::call('queue:forget', [
                'id' => $row->id,
            ]);
        });

        return response()->json(['status' => 'ok']);
    }
}
