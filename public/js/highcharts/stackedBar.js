function drawStackedBar(id, title, unit, categories, datas, band = 1000000, stacking = 'normal') {

    /*
     * Display chart
     */
    return Highcharts.chart(id, {
        chart: {
            type: 'column',
            height: $('#' + id + '.col-md-6').length ? 400 : 500,
            events: {
                redraw: function (event) {
                    if (typeof HighChartsRedraw !== 'undefined') {
                        HighChartsRedraw(id);
                    }
                }
            },
        },
        title: {
            text: title
        },
        legend: {
            enabled: (datas.length == 1 ? false : true),
            align: 'right',
            verticalAlign: 'top',
            layout: 'vertical',
            y: 35,
            width: '20%',
            useHTML: true,
        },
        xAxis: [{
                categories: categories,
                plotBands: [
                    {
                        from: band - 0.5,
                        to: band + 0.5,
                        color: '#E3F6FC'
                    }
                ],
                //Multiline label on X axis
                labels: {
                    step: 1,
                },
                isDirty: true,
            }],
        yAxis: [{
                title: {
                    text: unit
                },
            }],
        plotOptions: {
            column: {
                stacking: stacking
            }
        },
        tooltip: {
            useHTML: true,
            formatter: function () {
                var s = '<table><tr><td colspan="2" style="border-bottom:2px solid black"><b>' + this.x + '</b></td></tr>',
                        sum = 0;

                $.each(this.points, function (i, point) {
                    s += '<tr><td><i class="fas fa-square-full" style="color:' + point.series.color + ';"></i> ' + point.series.name + ' </td>' +
                            '<td style="text-align:right;padding-left:5px;"><b>' + (new Intl.NumberFormat('fr-FR').format(point.y)) + '</b></td></tr>';
                    sum += point.y;
                });


                s += '<tr><td style="border-top:2px solid black"><i>Sum</i></td><td  style="border-top:2px solid black;text-align:right"><b>' + (new Intl.NumberFormat('fr-FR').format(sum)) + '</b></td></tr>';

                s += '</table>';
                return s;
            },
            shared: true,
        },

        series: datas
    });
}
