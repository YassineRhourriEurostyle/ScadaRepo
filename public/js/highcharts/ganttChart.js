/**
 * 
 * @param {string} id DIV ID
 * @param {type} title: Graph title
 * @param {type} cats
 * @param {type} datas
 * @returns {HighCharts} Graph
 */
function ganttChart(id, title, colors, cats, datas) {

    return Highcharts.ganttChart(id, {
        title: {
            text: title
        },
        xAxis: {
            currentDateIndicator: {
                width: 1,
                dashStyle: 'dot',
                color: '#de1128',
                label: {
                    format: 'Today'
                }
            }
        },
        yAxis: {
            categories: cats
        },
        plotOptions: {
            gantt: {
                colors: colors
            }
        },
        series: datas
    });
}