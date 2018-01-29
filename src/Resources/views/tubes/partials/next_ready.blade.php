<next-job title="Next Ready" icon="fa fa-check" :job="nextReady">
    <div slot="list" v-if="nextReady">
        <dt>TTR</dt>
        <dd>@{{ nextReady.stats.ttr }}</dd>
    </div>

    <job-action url="/beanstalkd/api/jobs/"
                prefix="{{ $prefix }}"
                method="DELETE"
                button="btn-danger btn-sm"
                button-text="Delete Job"
                icon="fa fa-trash"
                :job="nextReady"
    >
    </job-action>
</next-job>
