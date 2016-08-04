<?php

namespace Sassnowski\BeanstalkdUI\Controllers;

use Illuminate\Routing\Controller;
use Pheanstalk\Exception\ServerException;
use Pheanstalk\PheanstalkInterface;

class TubesController extends Controller
{
    /**
     * @var Pheanstalk
     */
    private $pheanstalk;

    /**
     * BeanstalkdController constructor.
     *
     * @param PheanstalkInterface $pheanstalk
     */
    public function __construct(PheanstalkInterface $pheanstalk)
    {
        $this->pheanstalk = $pheanstalk;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tubeNames = collect($this->pheanstalk->listTubes());

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

        $nextBuried = null;
        $nextReady = null;
        $nextDelayed = null;

        try {
            $nextReady = $this->pheanstalk->peekReady($tube);
        } catch (ServerException $e) {
            //
        }

        try {
            $nextBuried = $this->pheanstalk->peekBuried($tube);
        } catch (ServerException $e) {
            //
        }

        try {
            $nextDelayed = $this->pheanstalk->peekDelayed($tube);
            $delayedStats = $this->pheanstalk->statsJob($nextDelayed);
        } catch (ServerException $e) {
            //
        }

        return view('beanstalkdui::tubes.show', compact(
            'nextReady',
            'nextBuried',
            'nextDelayed',
            'delayedStats',
            'stats',
            'tube'
        ));
    }
}
