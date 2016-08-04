<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('beanstalkd.tubes.index') }}" class="site_title"><i class="fa fa-paw"></i> <span>Beanstalkd UI</span></a>
        </div>

        <div class="clearfix"></div>

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="#"><i class="fa fa-server"></i>Server</a></li>
                    <li><a href="{{ route('beanstalkd.tubes.index') }}"><i class="fa fa-circle-o"></i>Tubes</a></li>

                    @foreach ($tubes as $tube)
                        <li>
                            <a href="{{ route('beanstalkd.tubes.show', ['tube' => $tube]) }}"><i
                                        class="fa fa-circle-o"></i> {{ $tube }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>

