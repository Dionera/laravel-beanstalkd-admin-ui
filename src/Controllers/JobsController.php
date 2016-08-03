<?php

namespace Sassnowski\BeanstalkdUI\Controllers;

use Illuminate\Routing\Controller;
use Pheanstalk\Exception\ServerException;
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
     * @param int $job
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($job)
    {
        try {
            $instance = $this->pheanstalk->peek($job);

            $this->pheanstalk->delete($instance);

            session()->flash('beanstalkd.success', 'Successfully deleted Job');

            return redirect()->back();
        } catch (ServerException $e) {
            session()->flash('beanstalkd.error', $e->getMessage());

            return redirect()->back();
        }
    }
}
