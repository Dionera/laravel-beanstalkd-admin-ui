<next-job title="Next Delayed" icon="fa fa-clock-o" :job="nextDelayed">
    <div slot="list" v-if="nextDelayed">
        <dt>Seconds until execution</dt>
        <dd>@{{ nextDelayed.stats['time-left'] }}</dd>
    </div>

    <job-action url="/beanstalkd/api/jobs/"
                method="POST"
                prefix="{{ $prefix }}"
                button="btn-success btn-sm"
                icon="fa fa-hand-o-up"
                button-text="Kick Job"
                :job="nextDelayed">
    </job-action>
</next-job>
