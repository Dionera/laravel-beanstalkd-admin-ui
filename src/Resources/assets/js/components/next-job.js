var NextJob = Vue.extend({
    template: '\
        <div class="col-md-4 col-xs-12">\
            <div class="x_panel">\
                <div class="x_title">\
                    <h2><span class="{{ icon }}"></span> {{ title }}</h2>\
                    <div class="clearfix"></div>\
                </div>\
                \
                <div class="x_content">\
                    <dl v-if="job">\
                        <dt>Id</dt>\
                        <dd>{{ job.id }}</dd>\
                        \
                        <dt>Data</dt>\
                        <dd>\
                            <pre>{{ job.data }}</pre>\
                        </dd>\
                        \
                        <slot name="list"></slot>\
                    </dl>\
                    \
                    <p v-else class="text-muted text-center">None</p>\
                </div>\
                <slot></slot>\
            </div>\
        </div>',

    props: ['title', 'job', 'icon']
});

Vue.component('next-job', NextJob);
