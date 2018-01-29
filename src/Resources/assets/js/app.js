new Vue({
    el: '#app',

    data: {
        tubeStats: {
            'current-watching': 0,
            'current-jobs-ready': 0,
            'current-jobs-reserved': 0,
            'current-jobs-delayed': 0,
            'total-jobs': 0,
            'cmd-delete': 0,
        },

        nextReady: null,
        nextDelayed: null,
        nextBuried: null
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
        fetchData: function () {
            $.get(this.prefixUrl('/beanstalkd/api/tubes/' + this.tube), function (response) {
                this.tubeStats = response.tubeStats
                this.nextReady = response.nextReady
                this.nextBuried = response.nextBuried
                this.nextDelayed = response.nextDelayed
            }.bind(this));
        }
    },

    ready: function () {
        this.fetchData();

        setInterval(function () {
            this.fetchData();
        }.bind(this), 2000);
    },

    events: {
        'notify': function (payload) {
            var title = payload.status === 'success'
                ? 'Success!'
                : 'Oh no!';

            new PNotify({
                title: title,
                type: payload.status,
                text: payload.message
            });
        }
    }
})
