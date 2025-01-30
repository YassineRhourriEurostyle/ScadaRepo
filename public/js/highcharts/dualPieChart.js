

function drawDualPieChart(id, title, datas) {

    var colors = [],
            base = '#de1128',
            i;

    for (i = 1; i < 7; i += 1) {
        c = {
            h: (360 / 7) * i,
            l: 0.47,
            s: 0.86
        };
        colors.push(hslToRGB(c));
    }
    colors.push('#535656');
    colors.push('#000000');
    colors.push('#ffffff');

    datas[0].showInLegend = true;
    datas[1].showInLegend = false;

    Highcharts.chart(id, {
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ["viewFullscreen", "separator", "downloadPNG", "downloadPDF"]
                }
            }
        },
        chart: {
//            events: {
//                redraw: function(event) {
//                    if(typeof HighChartsRedraw !== 'undefined') {
//                        HighChartsRedraw(id);
//                    }
//                }
//            },
            type: 'pie',
            options3d: {
                enabled: false,
                alpha: 45,
                beta: 0
            }
        },
        legend: {
            enabled: true,
            align: 'right',
            verticalAlign: 'top',
            layout: 'vertical',
            y: 35,
            width: 100,
            useHTML: true,
        },
        title: {
            text: title
        },
        subtitle: {
            text: datas[0].name + ' - ' + datas[1].name
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                borderWidth: 0,
                colors: colors,
            },
            series: {
                dataLabels: {
                    verticalAlign: 'top',
                    enabled: true,
                    color: '#000000',
                    connectorWidth: 1,
                    distance: -30,
                    connectorColor: '#000000',
                    formatter: function () {
                        return this.percentage >= 5 ? Math.round(this.percentage, 2) + ' %' : '';
                    }
                }
            }
        },
        series: datas
    }
    );
}