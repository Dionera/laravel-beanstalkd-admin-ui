new Vue({
    el: '#failed-jobs',

    data: {
        jobs: []
    },

    props: {
        tube: {
            type: String,
            required: true
        },
        prefix: {
            type: String,
            default:''
        }
    },

    methods: {
        prefixUrl: function (url){
            return this.prefix.length > 0
                ? '/' + this.prefix + url
                : url
        },
        refresh: function (notify) {
            $.get(this.prefixUrl('/beanstalkd/api/tubes/' + this.tube + '/failed'), function (response) {
                this.jobs = response;
            }.bind(this));

            if (notify) {
                this.notify('Refreshed failed jobs table.');
            }
        },

        forget: function (id, event) {
            event.preventDefault();
            $(event.target).prop('disabled', true);

            $.ajax({
                url: this.prefixUrl('/beanstalkd/api/tubes/' + this.tube + '/failed/' + id),
                type: 'DELETE',
                success: function () {
                    this.jobs = this.jobs.filter(function (job) {
                        return job.id != id;
                    });

                    this.notify('Deleted failed job.');
                }.bind(this)
            });
        },

        retry: function (id, event) {
            event.preventDefault();
            $(event.target).prop('disabled', true);

            $.post(this.prefixUrl('/beanstalkd/api/tubes/' + this.tube + '/failed/' + id), function (response) {
                this.jobs = this.jobs.filter(function (job) {
                    return job.id != id;
                });

                this.notify('Pushed failed job back onto the queue.');
            }.bind(this))
        },

        flush: function (event) {
            event.preventDefault();
            $(event.target).prop('disabled', true);

            $.ajax({
                url: this.prefixUrl('/beanstalkd/api/tubes/' + this.tube + '/failed'),
                type: 'DELETE',
                success: function () {
                    this.jobs = [];

                    $(event.target).prop('disabled', false);

                    this.notify('Flushed all failed jobs for this tube.');
                }.bind(this)
            });
        },

        notify: function (msg) {
            new PNotify({
                title: 'Success!',
                type: 'success',
                text: msg
            });
        }
    },

    ready: function () {
        this.refresh(false);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        PNotify.prototype.options.styling = 'fontawesome';
    }
});
