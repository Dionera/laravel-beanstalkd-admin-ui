var JobAction = Vue.extend({
    template: '\
        <div class="pull-right" v-if="job">\
            <button type="submit" class="btn {{ button }}" @click="fire">\
                <i class="{{ icon }}"></i> {{ buttonText }}\
            </button>\
            <div class="clearfix"></div>\
        </div>\
    ',

    props: ['url', 'button', 'icon', 'button-text', 'method', 'job', 'prefix'],

    methods: {
        prefixUrl: function (url){
            return this.prefix.length > 0
                ? '/' + this.prefix + url
                : url
        },
        fire: function () {
            $.ajax({
                url: this.prefixUrl(this.url + this.job.id),
                type: this.method,
                success: function (response) {
                    this.$dispatch('notify', response);
                }.bind(this)
            })
        }
    },

    ready: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    }
});

Vue.component('job-action', JobAction);
