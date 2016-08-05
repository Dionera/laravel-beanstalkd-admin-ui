<div class="row">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-eye text-info"></i></div>
            <div class="count">@{{ tubeStats['current-watching'] }}</div>
            <h3>Workers</h3>
            <p>Watching this tube</p>
        </div>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-check text-info"></i></div>
            <div class="count">
                @{{ tubeStats['current-jobs-ready'] }}
            </div>
            <h3>Jobs Ready</h3>
            <p>Will be worked shortly</p>
        </div>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-ellipsis-h text-info"></i></div>
            <div class="count">
                @{{ tubeStats['current-jobs-reserved'] }}
            </div>
            <h3>Reserved Jobs</h3>
            <p>Currently in the queue</p>
        </div>
    </div>

    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-clock-o text-info"></i></div>
            <div class="count">
                @{{ tubeStats['current-jobs-delayed'] }}
            </div>
            <h3>Delayed Jobs</h3>
            <p>Currently in the queue</p>
        </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 tile_stats_count">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-area-chart text-info"></i></div>
            <div class="count">
                @{{ tubeStats['total-jobs'] }}
            </div>
            <h3>Total Jobs</h3>
            <p>Since last restart</p>
        </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 tile_stats_count">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-bar-chart text-info"></i></div>
            <div class="count">
                @{{ tubeStats['cmd-delete'] }}
            </div>
            <h3>Finished Jobs</h3>
            <p>Have been worked in total</p>
        </div>
    </div>
</div>
