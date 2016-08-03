<?php

namespace Sassnowski\BeanstalkdUI\Controllers;

use Illuminate\Routing\Controller;

class ServersController extends Controller
{
    public function index()
    {
        return view('beanstalkdui::servers.index');
    }
}
