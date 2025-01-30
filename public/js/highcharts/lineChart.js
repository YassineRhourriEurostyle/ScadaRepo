function drawLineChart(id, title, datas, unit = 'Amount (k€)', categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], band = 1000000) {

    Highcharts.chart(id, {
        chart: {
            events: {
                redraw: function (event) {
                    if (typeof HighChartsRedraw !== 'undefined') {
                        HighChartsRedraw(id);
                    }
                }
            },
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ["viewFullscreen", "separator", "downloadPNG", "downloadPDF"]
                }
            }
        },
        title: {
            text: title
        },
        subtitle: {
            text: "" // 'Sites : All'
        },
        xAxis: {
            categories: categories,
            plotBands: [
                {
                    from: band - 0.5,
                    to: band + 0.5,
                    color: '#E3F6FC'
                }
            ]
        },
        yAxis: {
            title: {
                text: unit
            },
            min: 0,
            labels: {
                format: '{value}'
            }
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            layout: 'vertical',
            y: 35,
            width: 100,
            useHTML: true,
        },
        plotOptions: {
            line: {
                showInLegend: true,
            },
            series: {
                label: {
                    connectorAllowed: false
                }
            }
        },
        series: datas['series'],
        tooltip: {
            useHTML: true,
            formatter: function () {
                var s = '<table><tr><td class="standard-black" colspan="2" style="border-bottom:2px solid #565656"><b>' + this.x + '</b></td></tr>',
                        sum = 0;

                $.each(this.points, function (i, point) {
                    s += '<tr><td><i class="fas fa-slash" style="color:' + point.series.color + ';"></i> ' + point.series.name + '</td>' +
                            '<td class="standard-black" style="text-align:right;padding-left:5px;"><b>' + (new Intl.NumberFormat('fr-FR').format(point.y)) + '</b></td></tr>';
                    //sum += point.y;
                });


                //s += '<br/>-----------------<br/>Sum: <b>' + (new Intl.NumberFormat('fr-FR').format(sum)) + '</b>';

                s += '</table>';
                return s;
            },
            shared: true,
        },
        responsive: {
            rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
        }

    });
}