<?php

namespace Dionera\BeanstalkdUI\ViewComposers;

use Illuminate\View\View;
use Pheanstalk\Contract\PheanstalkInterface;

class LayoutComposer
{
    /**
     * @var PheanstalkInterface
     */
    private $pheanstalk;

    /**
     * LayoutComposer constructor.
     *
     * @param PheanstalkInterface $pheanstalk
     */
    public function __construct(PheanstalkInterface $pheanstalk)
    {
        $this->pheanstalk = $pheanstalk;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('tubes', $this->pheanstalk->listTubes());
    }
}
