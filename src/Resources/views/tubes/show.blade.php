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
                <div class="icon"><i class="fa fa-exclamation"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-urgent'] }}
                </div>
                <h3>Urgent Jobs</h3>
                <p>Currently in the queue</p>
            </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-ready'] }}
                </div>
                <h3>Jobs Ready</h3>
                <p>Will be worked shortly</p>
            </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-ellipsis-h"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-reserved'] }}
                </div>
                <h3>Reserved Jobs</h3>
                <p>Currently in the queue</p>
            </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-clock-o"></i></div>
                <div class="count">
                    {{ $stats['current-jobs-delayed'] }}
                </div>
                <h3>Delayed Jobs</h3>
                <p>Currently in the queue</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-area-chart"></i></div>
                <div class="count">
                    {{ $stats['total-jobs'] }}
                </div>
                <h3>Total Jobs</h3>
                <p>All time</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-bar-chart"></i></div>
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
        <div class="col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Next Ready</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if (isset($jobs['nextReady']))
                        <dl>
                            <dt>Id</dt>
                            <dd>{{ $jobs['nextReady']['id'] }}</dd>

                            <dt>Status</dt>
                            <dd><span class="label label-success">{{ $jobs['nextReady']['status'] }}</span></dd>

                            <dt>Data</dt>
                            <dd>
                                <pre>{{ $jobs['nextReady']['data'] }}</pre>
                            </dd>
                        </dl>
                    @else
                        <p class="text-muted">
                            None
                        </p>
                    @endif
                </div>

                @if (isset($jobs['nextReady']))
                <div class="x_footer">
                    <form action="{{ route('beanstalkd.jobs.delete', ['job' => $jobs['nextReady']['id']]) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-danger">
                            <fa class="fa fa-trash"></fa> Delete Job
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Next buried</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if (isset($data['nextBuried']))
                        <dl>
                            <dt>Id</dt>
                            <dd>{{ $data['nextBuried']['id'] }}</dd>

                            <dt>Status</dt>
                            <dd><span class="label label-warning">{{ $data['nextBuried']['status'] }}</span></dd>

                            <dt>Data</dt>
                            <dd>
                                <pre>{{ $data['nextBuried']['data'] }}</pre>
                            </dd>
                        </dl>
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
