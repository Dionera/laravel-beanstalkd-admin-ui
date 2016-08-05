@extends('beanstalkdui::layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/beanstalkdui/css/beanstalkdui.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tube &lt;{{ $tube }}&gt;</h1>
        </div>
    </div>

    <div id="app" tube="{{ $tube }}" v-cloak>
        <div class="row">
            <div class="col-lg-12">
                <h2>Overview</h2>
            </div>
        </div>

        @include('beanstalkdui::tubes.partials.stats_row')

        <div class="row">
            <div class="col-lg-12">
                <h2>Next up</h2>
            </div>
        </div>

        <div class="row">
            @include('beanstalkdui::tubes.partials.next_ready')

            @include('beanstalkdui::tubes.partials.next_buried')

            <div class="col-lg-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><span class="fa fa-clock-o"></span> Next Delayed</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <dl v-if="nextDelayed">
                            <dt>Id</dt>
                            <dd>@{{ nextDelayed.id }}</dd>

                            <dt>Data</dt>
                            <dd>
                                <pre>@{{ nextDelayed.data }}</pre>
                            </dd>

                            <dt>TTR</dt>
                            <dd>@{{ nextDelayed.stats.ttr }}</dd>

                            <dt>Seconds until execution</dt>
                            <dd>@{{ nextDelayed.stats['time-left'] }}</dd>
                        </dl>

                        <p v-else class="text-muted text-center">None</p>

                        <form action="/beanstalkd/jobs/@{{ nextDelayed.id }}"
                              method="POST"
                              v-if="nextDelayed">
                            {{ csrf_field() }}

                            <div class="pull-right">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-hand-o-up"></i> Kick Job
                                </button>

                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script src="{{ asset('vendor/beanstalkdui/js/vendor/vue.min.js') }}"></script>
    <script src="{{ asset('vendor/beanstalkdui/js/app.js') }}"></script>

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
