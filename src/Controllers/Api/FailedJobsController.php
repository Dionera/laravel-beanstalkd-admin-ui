<?php declare(strict_types=1);

namespace Dionera\BeanstalkdUI\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class FailedJobsController extends Controller
{
    public function index(string $tube): JsonResponse
    {
        $jobs = DB::table(config('beanstalkdui.failed_jobs_table'))
            ->where('queue', $tube)
            ->get();

        return response()->json($jobs);
    }

    public function forget(string $tube, int $failed): JsonResponse
    {
        Artisan::call('queue:forget', [
            'id' => $failed,
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function retry(string $tube, int $failed): JsonResponse
    {
        Artisan::call('queue:retry', [
            'id' => [$failed],
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function flush(string $tube): JsonResponse
    {
        $rows = DB::table(config('beanstalkdui.failed_jobs_table'))
            ->select('id')
            ->where('queue', $tube)
            ->get();

        // The reason we're using queue:forget here instead of queue:flush is,
        // that we only want to flush the jobs for the current queue. queue:flush
        // would simply empty the entire table.
        foreach ($rows as $row) {
            Artisan::call('queue:forget', [
                'id' => $row->id,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
