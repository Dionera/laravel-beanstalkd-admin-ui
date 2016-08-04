@extends('beanstalkdui::tubes.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tube &lt;{{ $tube }}&gt;</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Overview</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-exclamation text-info"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-urgent'] }}
                </div>
                <h3>Urgent Jobs</h3>
                <p>Currently in the queue</p>
            </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check text-info"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-ready'] }}
                </div>
                <h3>Jobs Ready</h3>
                <p>Will be worked shortly</p>
            </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-ellipsis-h text-info"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-reserved'] }}
                </div>
                <h3>Reserved Jobs</h3>
                <p>Currently in the queue</p>
            </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-clock-o text-info"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-delayed'] }}
                </div>
                <h3>Delayed Jobs</h3>
                <p>Currently in the queue</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-area-chart text-info"></i></div>
                <div class="count">
                    {{ $stats['total-jobs'] }}
                </div>
                <h3>Total Jobs</h3>
                <p>All time</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-bar-chart text-info"></i></div>
                <div class="count">
                    {{ $stats['cmd-delete'] }}
                </div>
                <h3>Finished Jobs</h3>
                <p>Have been worked in total</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Next up</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2><span class="fa fa-check"></span> Next Ready</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if ($nextReady)
                        <dl>
                            <dt>Id</dt>
                            <dd>{{ $nextReady->getId() }}</dd>

                            <dt>Data</dt>
                            <dd>
                                <pre>{{ $nextReady->getData() }}</pre>
                            </dd>
                        </dl>
                    @else
                        <p class="text-muted">
                            None
                        </p>
                    @endif
                </div>

                @if ($nextReady)
                    <form action="{{ route('beanstalkd.jobs.delete', ['job' => $nextReady->getId()]) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}

                        <div class="pull-right">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <fa class="fa fa-trash"></fa>
                                Delete Job
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2><span class="fa fa-gavel"></span> Next buried</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if ($nextBuried)
                        <dl>
                            <dt>Id</dt>
                            <dd>{{ $nextBuried->getId() }}</dd>

                            <dt>Data</dt>
                            <dd>
                                <pre>{{ $nextBuried->getData() }}</pre>
                            </dd>
                        </dl>
                    @else
                        <p class="text-muted">None</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="x_panel">
                <div class="x_title">
                    <h2><span class="fa fa-clock-o"></span> Next Delayed</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if ($nextDelayed)
                        <dl>
                            <dt>Id</dt>
                            <dd>{{ $nextDelayed->getId() }}</dd>

                            <dt>Data</dt>
                            <dd>
                                <pre>{{ $nextDelayed->getData() }}</pre>
                            </dd>

                            <dt>Time until execution</dt>
                            <dd>{{ Carbon\Carbon::now()->addSeconds($delayedStats['time-left'])->diffForHumans() }}</dd>
                        </dl>

                        <form action="{{ route('beanstalkd.jobs.kick', ['job' => $nextDelayed->getId()]) }}"
                              method="POST">
                            {{ csrf_field() }}

                            <div class="pull-right">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-hand-o-up"></i> Kick Job
                                </button>

                                <div class="clearfix"></div>
                            </div>
                        </form>
                    @else
                        <p class="text-muted">None</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @if (Session::has('beanstalkd.error'))
        <script>
            PNotify.prototype.options.styling = 'fontawesome';

            new PNotify({
                title: 'Oh no!',
                type: 'error',
                text: '{{ Session::get('beanstalkd.error') }}'
            });
        </script>
    @endif

    @if (Session::has('beanstalkd.success'))
        <script>
            PNotify.prototype.options.styling = 'fontawesome';

            new PNotify({
                title: 'Success!',
                type: 'success',
                text: '{{ Session::get('beanstalkd.success') }}'
            });
        </script>
    @endif
@stop
@stop
