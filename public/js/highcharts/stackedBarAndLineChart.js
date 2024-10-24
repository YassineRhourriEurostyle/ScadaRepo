function drawStackedBarAndLineChart(id, unit, datas, imgValid,
        categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], zoomed = 0) {

    var yMin = null;
    var yMax = null;


    /*
     * Looking forward limits (min & max, target & realized) if zoomed
     */
    if (parseInt(zoomed)) {
        yMax = 0;
        yMin = 1000000000;
        for (i = 0; i < categories.length; i++) {
            if (datas[0]['data'][i]['y'] && datas[0]['data'][i]['y'] > yMax)
                yMax = datas[0]['data'][i]['y'];
            if (datas[0]['data'][i]['y'] && datas[0]['data'][i]['y'] < yMin)
                yMin = datas[0]['data'][i]['y'];
            if (datas[1]['data'][i]['y'] && datas[1]['data'][i]['y'] > yMax)
                yMax = datas[1]['data'][i]['y'];
            if (datas[1]['data'][i]['y'] && datas[1]['data'][i]['y'] < yMin)
                yMin = datas[1]['data'][i]['y'];
        }
        if (yMin > yMax)
            yMin = yMax;
        yMin = yMin * 0.9999;
        console.log(yMin + ' / ' + yMax);
    }


    /*
     * Display chart
     */
    var cellWidth = $(window).width() / 22;
    return Highcharts.chart(id, {
        chart: {
            zoomType: 'xy',
            height: $('#' + id).height(),
            margin: [0, 0, 0, 0],
            marginLeft: cellWidth,
            marginTop: 20,
            marginBottom: 25,
            spacingLeft: 50
        },
        title: {
            text: ''
        },
        xAxis: [{
                categories: categories,
                crosshair: true
            }],
        yAxis: [{
                title: {
                    text: unit
                },
                min: yMin,
                max: yMax,
                stackLabels: {
                    enabled: false,
                }
            }],
        plotOptions: {
            column: {
                stacking: 'normal'
            },
        },
        tooltip: {
            useHTML: true,
            formatter: function () {
                var s = '<table class="table-borderless">';
                var sum = 0;

                if (this.x)
                    s += '<tr><td colspan="2" class="standard-black" style="border-bottom:2px solid black"><b>' + this.x + '</b></td></tr>';

                //Bar
                var nb = 0;
                $.each(this.points, function (i, point) {
                    if (point.point.barX) {
                        s += '<tr><td class="standard-black"><i class="fas fa-square-full" style="color:' + (point.color ? point.color : point.series.color) + ';"></i> ' + point.series.name + ' </td>' +
                                '<td class="standard-black" style="text-align:right;padding-left:5px;"><b>' + (new Intl.NumberFormat('fr-FR').format(point.y)) + '</b></td></tr>';
                        sum += point.y;
                        nb++;
                    }
                });
                if (nb > 1)
                    s += '<tr><td style="border-top:2px solid black"><i>Sum stacked bar</i></td><td  style="border-top:2px solid black;text-align:right"><b>' + (new Intl.NumberFormat('fr-FR').format(sum)) + '</b></td></tr>';

                //Line
                $.each(this.points, function (i, point) {
                    if (!point.point.barX) {
                        s += '<tr><td class="standard-black" style="border-top:2px solid black;"><i class="fas fa-slash" style="color:' + (point.color ? point.color : point.series.color) + ';"></i> ' + point.series.name + ' </td>' +
                                '<td class="standard-black" style="border-top:2px solid black;text-align:right;padding-left:5px;"><b>' + (new Intl.NumberFormat('fr-FR').format(point.y)) + '</b></td></tr>';
                    }
                });

                s += '</table>';
                return s;
            },
            shared: true
        },
        legend: {
            enabled: false
        },
        series: datas
    }, function (chart) { // on complete

        chart.renderer.image(imgValid, 0, 10, 50, 50)
                .add();

    });
}
