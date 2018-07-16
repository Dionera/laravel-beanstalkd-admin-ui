<hr>
<div class="row" id="failed-jobs" tube="{{ $tube }}" prefix="{{ $prefix }}" v-cloak>
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><span class="fa fa-remove"></span> Failed Jobs</h2>

                <div class="pull-right">
                    <button href="#" class="btn btn-sm btn-success" v-on:click="refresh(true)">
                        <i class="fa fa-refresh"></i> Refresh
                    </button>

                    <button class="btn btn-sm btn-danger" v-on:click="flush">
                        <i class="fa fa-trash"></i> Flush
                    </button>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-horizontal table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Actions</th>
                        <th>Connection</th>
                        <th>Queue</th>
                        <th>Payload</th>
                        <th>Exception</th>
                        <th>Failed At</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="job in jobs">
                        <td>@{{ job.id }}</td>
                        <td>
                            <a href="#" v-on:click="forget(job.id, $event)" class="btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i> Forget
                            </a>

                            <a href="#" v-on:click="retry(job.id, $event)" class="btn btn-success btn-xs">
                                <i class="fa fa-refresh"></i> Retry
                            </a>
                        </td>
                        <td>@{{ job.connection }}</td>
                        <td>@{{ job.queue }}</td>
                        <td>@{{ job.payload }}</td>
                        <td>@{{ job.exception }}</td>
                        <td>@{{ job.failed_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
