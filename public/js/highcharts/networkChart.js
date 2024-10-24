function networkChart(id, title, nodes, data) {
    Highcharts.chart(id, {
        chart: {
            type: 'networkgraph',
            height: '400px'
        },
        title: {
            text: title
        },
        plotOptions: {
            networkgraph: {
                keys: ['from', 'to'],
                layoutAlgorithm: {
                    enableSimulation: false,
                    integration: 'euler',
                    friction: -0.9
                }
            }
        },
        series: [{
                dataLabels: {
                    enabled: true,
                    linkFormat: ''
                },
                id: 'lang-tree',
                nodes: nodes,
                data: data,
            }]
    });
}