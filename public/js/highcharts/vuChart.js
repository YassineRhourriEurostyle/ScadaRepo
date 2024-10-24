function drawVuChart(id, title, datas) {

    var panes = [];
    var yAx = [];
    for (i = 0; i < datas.length; i++) {
        if (datas[i].data[0] > 120)
            datas[i].data[0] = 120;
        panes.push({
            startAngle: -25,
            endAngle: 25,
            background: null,
            center: [(2 * (i + 1) - 1) * 100 / (datas.length * 2) + '%', '145%'],
            size: 300
        });

        yAx.push({
            min: 0,
            max: 120,
            minorTickPosition: 'outside',
            tickPosition: 'outside',
            labels: {
                rotation: 'auto',
                distance: 20
            },
            plotBands: [{
                    from: 100,
                    to: 120,
                    color: '#C02316',
                    innerRadius: '100%',
                    outerRadius: '105%'
                }],
            pane: i,
            title: {
                text: datas[i].name,
                y: -40
            }
        });
    }

    Highcharts.chart(id, {
        chart: {
            type: 'gauge',
            plotBorderWidth: 1,
            plotBackgroundColor: {
                linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                stops: [
                    [0, '#FFF4C6'],
                    [0.3, '#FFFFFF'],
                    [1, '#FFF4C6']
                ]
            },
            plotBackgroundImage: null,
            height: 200
        },

        title: {
            text: title
        },

        pane: panes,

        exporting: {
            enabled: false
        },

        tooltip: {
            enabled: false
        },

        yAxis: yAx,

        plotOptions: {
            gauge: {
                dataLabels: {
                    enabled: false
                },
                dial: {
                    radius: '100%'
                }
            }
        },

        series: datas

    }
    );
}

