/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function drawDonutChart(id, title, data) {
    
    var colors = [],
            base = '#de1128',
            i, j;

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

    var innerData = [], outerData = [];
    var innerTitle = data[Object.keys(data)[0]].title, outerTitle = data[Object.keys(data)[0]].drilldown.title;

    for (i = 0; i < Object.keys(data).length; i++) {
        var d = data[Object.keys(data)[i]];
        innerData.push({
            name: d.drilldown.name,
            y: parseInt(d.y),
            color: colors[i%colors.length]
        });

        drillDataLen = d.drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            outerData.push({
                name: d.drilldown.categories[j],
                y: parseFloat(d.drilldown.data[j]),
                color: desaturate(colors[i%colors.length], j),
            });
        }
    }

    return Highcharts.chart(id, {
        chart: {
            type: 'pie'
        },
        title: {
            text: title
        },

        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            },
            serie: {
                turboThreshold: 0
            }
        },
        tooltip: {
            valueSuffix: 'MB'
        },
        series: [{
                name: innerTitle,
                data: innerData,
                size: '60%',
                dataLabels: {
                    formatter: function () {
                        return this.y > 5 ? this.point.name : null;
                    },
                    color: '#ffffff',
                    distance: -30
                }
            }, {
                name: outerTitle,
                data: outerData,
                size: '80%',
                innerSize: '60%',
                dataLabels: {
                    formatter: function () {
                        // display only if larger than 1
                        return this.y > 1 ? '<b>' + this.point.name + ':</b> ' +
                                this.y + ' MB' : null;
                    }
                },
                id: 'outerData'
            }],
        responsive: {
            rules: [{
                    condition: {
                        maxWidth: 400
                    },
                    chartOptions: {
                        series: [{
                            }, {
                                id: 'outerData',
                                dataLabels: {
                                    enabled: false
                                }
                            }]
                    }
                }]
        }
    });
}