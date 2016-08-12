<div class="col-md-4 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><span class="fa fa-check"></span> Next Ready</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <dl v-if="nextReady">
                <dt>Id</dt>
                <dd>@{{ nextReady.id }}</dd>

                <dt>Data</dt>
                <dd>
                    <pre>@{{ nextReady.data }}</pre>
                </dd>

                <dt>TTR</dt>
                <dd>@{{ nextReady.stats.ttr }}</dd>
            </dl>

            <p v-else class="text-muted text-center">None</p>
        </div>

        <form action="/beanstalkd/jobs/@{{ nextReady.id }}"
              method="POST"
              v-if="nextReady">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}

            <div class="pull-right">
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                    Delete Job
                </button>
            </div>

            <div class="clearfix"></div>
        </form>
    </div>
</div>
