/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    var chart;

    $('select').on('change', function () {

    });
});

function drawMapAndPieChart(id, title, pointFormat, data) {

    var minX = 180, maxX = -180, minY = 180, maxY = -180;

    for (i = 0; i < data.length; i++) {
        if (data[i].lat < minX)
            minX = data[i].lat;
        if (data[i].lat > maxX)
            maxX = data[i].lat;
        if (data[i].lon < minY)
            minY = data[i].lon;
        if (data[i].lon > maxY)
            maxY = data[i].lon;
    }

    var chart = Highcharts.mapChart(id, {
        chart: {
            borderWidth: 0,
            map: 'custom/world'
        },
        title: {
            text: title
        },
        subtitle: {
            text: 'No filter'
        },
        legend: {
            enabled: false
        },
        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },
        series: [{
                name: 'Countries',
                color: '#e0e0e0',
                enableMouseTracking: false
            }, {
                type: 'mapbubble',
                name: title,
                data: data,
                minSize: 10,
                maxSize: '20%',
                tooltip: {
                    pointFormat: pointFormat
                }
            }]
    });

    point = chart.fromLatLonToPoint({"lat": (minX + maxX) / 2, "lon": (minY + maxY) / 2});
    chart.mapZoom(0.25, point.x, point.y);
    return chart;
}

function getMapBlankStructure(lat, lon, city) {
    return {
        lat: lat,
        lon: lon,
        z: 0,
        city: city,
        color: "#1128de"
    };
}

function updateSubtitleFromFilters(chart) {
    if (!chart)
        return;
    var filter = [];
    $('select.select-filter').each(function () {
        if ($(this).val())
            filter.push($(this).find('option[value=' + $(this).val() + ']').text());
    });
    if (filter.length)
        subtitle = 'Filter: ' + filter.join(' / ');
    else
        subtitle = 'No filter';
    chart.setTitle(null, {text: subtitle});
}
