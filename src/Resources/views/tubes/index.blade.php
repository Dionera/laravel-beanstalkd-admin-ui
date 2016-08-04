@extends('beanstalkdui::layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Beanstalkd Admin UI</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tubes</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @include('beanstalkdui::tubes.partials.tube-table')
                </div>
            </div>
        </div>
    </div>
@stop

