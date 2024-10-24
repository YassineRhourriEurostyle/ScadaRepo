

function drawPieChart(id, title, datas) {

//    for (s = 0; s < datas.length; s++) {        
//        datas[s]['color'] = setColorFromText(datas[s]['name']);
//    }

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

    Highcharts.chart(id, {
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ["viewFullscreen", "separator", "downloadPNG", "downloadPDF"]
                }
            }
        },
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: title
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                colors: colors,
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            },
            series: {
                cursor: 'pointer',
                events: {
                    click: function (event) {
                        rev = $('#filterRev').val();
                        type = 0;
                        purpose = 0;
                        search = '';
                        if ($('#filterSite').length) {
                            site = $('#filterSite').val();
                            search = encodeURI(event.point.options.name);
                        } else {
                            site = '0/' + encodeURI(event.point.options.name) + '/0';
                        }
                        
                        if ($('#filterType').length) type=$('#filterType').val();

                        window.open('/budget/' + site + '/' + rev + '/' + type + '/' + purpose + '?search=' + search);
                    }
                }
            }
        },
        series: [{
                name: 'Serie',
                colorByPoint: true,
                data: datas
            }]
    }
    );
}