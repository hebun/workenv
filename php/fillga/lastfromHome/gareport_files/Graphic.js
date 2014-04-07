//var lineChartData =
//        [
//            { date: new Date(2009, 10, 20), value: 25 },
//            { date: new Date(2009, 10, 23), value: 29 },
//            { date: new Date(2009, 10, 24), value: 28 },
//            { date: new Date(2009, 10, 25), value: 30 },
//            { date: new Date(2009, 10, 26), value: 72 },
//            { date: new Date(2009, 10, 27), value: 43 },
//            { date: new Date(2009, 10, 30), value: 31 },
//            { date: new Date(2009, 10, 31), value: 30 },
//            { date: new Date(2009, 11, 2), value: 29 },
//            { date: new Date(2009, 11, 3), value: 27 },
//            { date: new Date(2009, 11, 4), value: 26 },
//            { date: new Date(2009, 12, 2), value: 5 },
//            { date: new Date(2009, 12, 3), value: 15 },
//            { date: new Date(2009, 12, 4), value: 13 },
//            { date: new Date(2009, 12, 5), value: 17 },
//            { date: new Date(2009, 12, 6), value: 15 },
//            { date: new Date(2009, 12, 9), value: 19 },
//            { date: new Date(2009, 12, 10), value: 21 },
//            { date: new Date(2009, 12, 11), value: 20 },
//            { date: new Date(2009, 12, 12), value: 20 },
//            { date: new Date(2009, 12, 13), value: 19 },
//            { date: new Date(2009, 12, 16), value: 25 },
//            { date: new Date(2009, 12, 17), value: 24 },
//            { date: new Date(2009, 12, 18), value: 26 },
//            { date: new Date(2009, 12, 19), value: 27 },
//            { date: new Date(2009, 12, 20), value: 25 },
//            { date: new Date(2009, 12, 23), value: 29 },
//            { date: new Date(2009, 12, 24), value: 28 },
//            { date: new Date(2009, 12, 25), value: 30 },
//            { date: new Date(2009, 12, 26), value: 120 },
//            { date: new Date(2009, 12, 27), value: 43 },
//            { date: new Date(2009, 12, 30), value: 31 }
//        ];

AmCharts.ready(function () {

    var chart = new AmCharts.AmSerialChart();
    chart.dataProvider = lineChartData;
    chart.pathToImages = "amcharts/images/";
    chart.categoryField = "date";

    // sometimes we need to set margins manually
    // autoMargins should be set to false in order chart to use custom margin values
    chart.autoMargins = false;
    chart.marginRight = 0;
    chart.marginLeft = 0;
    chart.marginBottom = 55;
    chart.marginTop = 0;

    // AXES
    // category                
    var categoryAxis = chart.categoryAxis;
    categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
    categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
    categoryAxis.inside = false;
    categoryAxis.gridAlpha = 0;
    categoryAxis.tickLength = 0;
    categoryAxis.axisAlpha = 0;

    // value
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.dashLength = 4;
    valueAxis.axisAlpha = 0;
    chart.addValueAxis(valueAxis);

    // GRAPH
    var graph = new AmCharts.AmGraph();
    graph.type = "line";
    graph.valueField = "value";
    graph.lineColor = "#0066cc";
    graph.customBullet = "amcharts/images/star.gif"; // bullet for all data points
    graph.bulletSize = 11; // bullet image should be a rectangle (width = height)
    graph.customBulletField = "customBullet"; // this will make the graph to display custom bullet (red star)
    chart.addGraph(graph);

    // CURSOR
    var chartCursor = new AmCharts.ChartCursor();
    chart.addChartCursor(chartCursor);

    // WRITE
    chart.write("chartdiv");
});