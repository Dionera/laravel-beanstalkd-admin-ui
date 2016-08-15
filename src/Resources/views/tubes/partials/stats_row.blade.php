<div class="row">
    <tube-stat
            title="Connections"
            icon="fa fa-eye"
            :value="tubeStats['current-watching']"
            subtitle="Watching this tube">
    </tube-stat>

    <tube-stat
            title="Jobs Ready"
            icon="fa fa-check"
            :value="tubeStats['current-jobs-ready']"
            subtitle="Currently in the queue">
    </tube-stat>

    <tube-stat
            title="Reserved Jobs"
            icon="fa fa-ellipsis-h"
            :value="tubeStats['current-jobs-reserved']"
            subtitle="Have been reserved by a worker">
    </tube-stat>

    <tube-stat
            title="Delayed Jobs"
            icon="fa fa-clock-o"
            :value="tubeStats['current-jobs-delayed']"
            subtitle="Currently in the queue">
    </tube-stat>

    <tube-stat
            title="Total Jobs"
            icon="fa fa-area-chart"
            :value="tubeStats['total-jobs']"
            subtitle="Since last restart">
    </tube-stat>

    <tube-stat
            title="Finished Jobs"
            icon="fa fa-bar-chart"
            :value="tubeStats['cmd-delete']"
            subtitle="Have been worked in total">
    </tube-stat>
</div>
