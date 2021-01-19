<script>
    google.charts.load('current', {'packages':['corechart','controls']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {
    drawBodyPartsCountChart();
    drawDescriptionCountChart();
    drawPainLevelChart();
    drawTopPainChart();
    drawMoodChart();
    drawDurationChart();
}

function drawBodyPartsCountChart(){
    var bodyPartsCountData = google.visualization.arrayToDataTable([
        ['body parts','count'],

        @php
        foreach($bodyPartsCount as $item) {
            echo "['".$item->body_part."',parseInt('".$item->count."')],";
        }
        @endphp
        ]);

    // Set chart options
    var bodyPartsCountOptions = {'title':'sample',
                    'width':600,
                    'height':300};

    // Instantiate and draw our chart, passing in some options.
    var bodyPartsCountChart = new google.visualization.BarChart(document.getElementById('body-parts-chart-div'));
    bodyPartsCountChart.draw(bodyPartsCountData, bodyPartsCountOptions);
}

function drawDescriptionCountChart(){
    var descriptionCountData = google.visualization.arrayToDataTable([
        ['body parts','description','count'],

        @php
        foreach($descriptionCount as $item) {
            echo "['".$item->body_part."','".$item->description."',parseInt('".$item->count."')],";
        }
        @endphp
    ]);

    // Create a dashboard.
    var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));

    var bodyPartSelector = new google.visualization.ControlWrapper({
        'controlType': 'CategoryFilter',
        'containerId': 'filter_div',
        'options': {
        'filterColumnLabel': 'body parts'
        }
    });

    var pieChart = new google.visualization.ChartWrapper({
        'chartType': 'PieChart',
        'containerId': 'chart_div',
        'dataTable':descriptionCountData,
        'options': {
            'width': 300,
            'height': 300,
            'title': 'Pain description count'
        },
        // The pie chart will use the columns 'Name' and 'Donuts eaten'
        // out of all the available ones.
        'view': {'columns': [ 1, 2]}
    });

    // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    dashboard.bind(bodyPartSelector, pieChart);

    dashboard.draw(descriptionCountData);
}

function drawPainLevelChart(){
     // third chart

    var levelData = google.visualization.arrayToDataTable([
        ['date','level'],

        @php
        foreach($reports as $item) {
            // echo "[new Date('".$item->created_at."'.substr(0,10)),parseInt('".$item->level."')],";
            echo "[new Date('".$item->created_at."'),parseInt('".$item->level."')],";
        }
        @endphp
    ]);

    // Create a dashboard.
    var dashboard2 = new google.visualization.Dashboard(
            document.getElementById('dashboard2_div'));

    var dateRangeFilter = new google.visualization.ControlWrapper({
        'controlType': 'ChartRangeFilter',
        'containerId': 'filter2_div',
        'options': {
        'filterColumnLabel': 'date',
            ui:{
                chartOptions: {
                    height:50,
                    width:600,
                }
            }
        }
    });

    

    var lineChart = new google.visualization.ChartWrapper({
        'chartType': 'LineChart',
        'containerId': 'chart2_div',
        'dataTable':levelData,
        'options': {
            'width': 900,
            'height': 500,
            'title': 'Level of pain'
        },
    });

    // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    dashboard2.bind(dateRangeFilter, lineChart);

    dashboard2.draw(levelData);

}

function drawTopPainChart(){
       // forth chart

    var highestPainData = google.visualization.arrayToDataTable([
        ['description','level','date','body part'],

        @php
        foreach($highestPainLevel as $item) {
            echo "['".$item->description."',parseInt('".$item->level."'),new Date('".$item->created_at."'),'".$item->body_part."'],";
        }
        @endphp
    ]);

     // Create a dashboard.
    var highestPainDashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard3_div'));

    var dateRangeFilter2 = new google.visualization.ControlWrapper({
        'controlType': 'DateRangeFilter',
        'containerId': 'filter3_div',
        'options': {
        'filterColumnLabel': 'date'
        }
    });

    var filter2 = new google.visualization.ControlWrapper({
        'controlType': 'CategoryFilter',
        'containerId': 'filter3_1_div',
        'options': {
        'filterColumnLabel': 'body part'
        }
    });
    
    var highestPainBarChart = new google.visualization.ChartWrapper({
        'chartType': 'BarChart',
        'containerId': 'highestPainDataChart_div',
        'dataTable':highestPainData,
        'options': {
            'width': 500,
            'height': 300,
            'title': 'Pain description count'
        },
        'view':{'columns':[0,1]}
    });

     // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    highestPainDashboard.bind(dateRangeFilter2, highestPainBarChart);
    highestPainDashboard.bind(filter2, highestPainBarChart);

    highestPainDashboard.draw(highestPainData);
}

function drawMoodChart(dashboard, filter){
       var data = google.visualization.arrayToDataTable([
        ['date','mood'],

        @php
        foreach($reports as $item) {
            echo "[new Date('".$item->created_at."'),parseInt('".$item->mood."')],";
        }
        @endphp
    ]);

     // Create a dashboard.
    var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard4_div'));

    var filter = new google.visualization.ControlWrapper({
        'controlType': 'DateRangeFilter',
        'containerId': 'filter4_div',
        'options': {
        'filterColumnLabel': 'date'
        }
    });
    
    var chart = new google.visualization.ChartWrapper({
        'chartType': 'LineChart',
        'containerId': 'chart4_div',
        'dataTable':data,
        'options': {
            'width': 500,
            'height': 300,
            'title': 'Pain description count'
        },
    });

     // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    dashboard.bind(filter, chart);

    dashboard.draw(data);
}

function drawDurationChart(){
    var data = google.visualization.arrayToDataTable([
        ['body part','duration','average','date'],

        @php
        foreach($durationPerBodyPart as $item) {
            echo "['".$item->body_part."',parseInt('".$item->duration."'),parseFloat('".$item->average."'),new Date('".$item->created_at."')],";
        }
        @endphp
    ]);

     // Create a dashboard.
    var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard5_div'));

    var filter = new google.visualization.ControlWrapper({
        'controlType': 'DateRangeFilter',
        'containerId': 'filter5_div',
        'options': {
        'filterColumnLabel': 'date'
        }
    });
    
    var chart = new google.visualization.ChartWrapper({
        'chartType': 'BarChart',
        'containerId': 'chart5_div',
        'dataTable':data,
        'options': {
            'width': 500,
            'height': 300,
            'title': 'Pain description count'
        },
        'view': {'columns': [0,1,2]}
    });

     // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    dashboard.bind(filter, chart);

    dashboard.draw(data);
}
</script>
<p>hello</p>
<p>{{$patient->first_name}}</p>