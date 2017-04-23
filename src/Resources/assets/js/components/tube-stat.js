var TubeStat = Vue.extend({
    template: '\
        <div class="col-lg-2 col-sm-4 col-xs-12 tile_stats_count">\
            <div class="tile-stats">\
                <div class="icon"><i class="{{ icon }} text-info"></i></div>\
                <div class="count">{{ value }}</div>\
                <h3>{{ title }}</h3>\
                <p>{{ subtitle }}</p>\
            </div>\
        </div>',

    props: ['icon', 'title', 'value', 'subtitle']
});

Vue.component('tube-stat', TubeStat);
