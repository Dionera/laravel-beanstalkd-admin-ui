<?php

namespace Dionera\BeanstalkdUI\Controllers;

use Illuminate\Routing\Controller;
use Pheanstalk\Contract\PheanstalkInterface;
use Dionera\BeanstalkdUI\Repositories\JobRepository;

class TubesController extends Controller
{
    /**
     * @var Pheanstalk
     */
    private $pheanstalk;
    /**
     * @var JobRepository
     */
    private $jobs;

    /**
     * BeanstalkdController constructor.
     *
     * @param PheanstalkInterface $pheanstalk
     * @param JobRepository       $jobs
     */
    public function __construct(PheanstalkInterface $pheanstalk, JobRepository $jobs)
    {
        $this->pheanstalk = $pheanstalk;
        $this->jobs = $jobs;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tubeNames = collect($this->pheanstalk->listTubes());

        // Adam Wathan give me your strength!
        $tubes = collect($tubeNames)->map(function ($tube) {
            return collect($this->pheanstalk->statsTube($tube))->slice(1)->all();
        })->zip($tubeNames)->flatMap(function ($pair) {
            return [$pair[1] => $pair[0]];
        });

        return view('beanstalkdui::tubes.index', compact('tubes'));
    }

    /**
     * @param string $tube
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTube($tube)
    {
        $stats = $this->pheanstalk->statsTube($tube);

        $nextReady = $this->jobs->nextReady($tube, true);
        $nextBuried = $this->jobs->nextBuried($tube);
        $nextDelayed = $this->jobs->nextDelayed($tube, true);
        $prefix = config('beanstalkdui.prefix');

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
