<?php declare(strict_types=1);

namespace Dionera\BeanstalkdUI\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Pheanstalk\Contract\PheanstalkInterface;
use Dionera\BeanstalkdUI\Repositories\JobRepository;

class TubesController extends Controller
{
    private PheanstalkInterface $pheanstalk;
    private JobRepository $jobs;

    public function __construct(PheanstalkInterface $pheanstalk, JobRepository $jobs)
    {
        $this->pheanstalk = $pheanstalk;
        $this->jobs = $jobs;
    }

    public function index(): View
    {
        $tubeNames = $this->pheanstalk->listTubes();
        
        // its better if tubes sorted by alphabet so we can find them faster
        sort($tubeNames);

        // Adam Wathan give me your strength!
        $tubes = collect($tubeNames)->map(function ($tube) {
            return collect($this->pheanstalk->statsTube($tube))->slice(1)->all();
        })->zip($tubeNames)->flatMap(function ($pair) {
            return [$pair[1] => $pair[0]];
        });

        return view('beanstalkdui::tubes.index', compact('tubes'));
    }

    public function showTube(string $tube): View
    {
        $stats = $this->pheanstalk->statsTube($tube);

        $nextReady = $this->jobs->nextReady($tube, true);
        $nextBuried = $this->jobs->nextBuried($tube);
        $nextDelayed = $this->jobs->nextDelayed($tube, true);
        $prefix = url()->to('/'.config('beanstalkdui.prefix'));

        return view('beanstalkdui::tubes.show', compact(
            'nextReady',
            'nextBuried',
            'nextDelayed',
            'stats',
            'tube',
            'prefix'
        ));
    }
}
