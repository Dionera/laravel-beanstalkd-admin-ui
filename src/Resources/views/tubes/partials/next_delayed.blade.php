<div class="col-md-4 col-xs-12">
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

