@extends('beanstalkdui::layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/beanstalkdui/css/beanstalkdui.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            @include('beanstalkdui::tubes.partials.next_delayed')

        </div>
    </div>

    @if (config('beanstalkdui.failed_jobs'))
        @include('beanstalkdui::tubes.partials.failed_table')
    @endif
@stop


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js"></script>
    <script src="{{ asset('vendor/beanstalkdui/js/app.js') }}"></script>

    @if (config('beanstalkdui.failed_jobs'))
        <script src="{{ asset('vendor/beanstalkdui/js/failed-jobs-table.js') }}"></script>
    @endif

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
