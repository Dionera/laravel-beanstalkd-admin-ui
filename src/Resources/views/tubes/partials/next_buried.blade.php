<div class="col-md-4 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><span class="fa fa-gavel"></span> Next buried</h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <dl v-if="nextBuried">
                <dt>Id</dt>
                <dd>@{{ nextBuried.id }}</dd>

                <dt>Data</dt>
                <dd>
                    <pre>@{{ nextBuried.data }}</pre>
                </dd>
            </dl>
            <p v-else class="text-muted text-center">None</p>
        </div>
    </div>
</div>

