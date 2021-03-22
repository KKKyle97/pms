<?php
use App\Common;
?>

<script>
    //create trigger to resizeEnd event     
    $(window).resize(function() {
        drawChart($("#chart-dropdown").val());
    });

    //redraw graph when window resize is completed 
    
    google.charts.load('current', {
        callback: function () {
        drawChart("1");
        $('#chart-dropdown').on('change', function() {
            drawChart(this.value);
        });
  },
  packages:['corechart','controls']
});

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart(val) {
    switch (val) {
        case "1":
            drawBodyPartsCountChart();
            break;

        case "2":
            drawDescriptionCountChart();
            break;

        case "3":
            drawPainLevelChart();
            break;
        
        case "4":
            drawTopPainChart();
            break;

        case "5":
            drawMoodChart();
            break;

        case "6":
            drawDurationChart();
            break;

        default:
            drawBodyPartsCountChart();
            break;
    }
}

function drawBodyPartsCountChart(){
    var bodyPartsCountData = google.visualization.arrayToDataTable([
        ['body parts','Number of Pain'],

        @php
        foreach($bodyPartsCount as $item) {
            echo "['".$item->body_part."',parseInt('".$item->count."')],";
        }
        @endphp
        ]);

    // Set chart options
    var bodyPartsCountOptions = {
            // leave room for y-axis labels
        'title':'The Number Of Pain According To The Body Parts',
        'hAxis': { 
            format: '0',
            title: 'Number of Pains'
            },
        'vAxis':{
            title: 'Body Parts'
        }
        };

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

    var filterArray = [@php

            echo "'".$descriptionCount[0]->body_part."',";
        
        @endphp];

    console.log(filterArray);

    // Create a dashboard.
    var dashboard = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));

    var bodyPartSelector = new google.visualization.ControlWrapper({
        'controlType': 'CategoryFilter',
        'containerId': 'filter_div',
        'options': {
        'filterColumnLabel': 'body parts',
        'ui':{
            label: 'Body Part Selection:',
            allowMultiple:false,
            allowTyping:false,
            }
        },
        state: {
            selectedValues: filterArray,
        },
    });

    var pieChart = new google.visualization.ChartWrapper({
        'chartType': 'PieChart',
        'containerId': 'chart_div',
        'dataTable':descriptionCountData,
        'options': {
            // leave room for y-axis labels
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
    var data = [
        @php
        foreach($reports as $item) {
            echo "[new Date('".$item->created_at."'.substr(0,10)),parseInt('".$item->level."')],";
            //echo "[date('Y-m-d',strtotime(".$item->created_at."),parseInt('".$item->level."')],";
        }
        @endphp
    ];


    var levelData = google.visualization.arrayToDataTable([
        ['date','level'],

        @php
        foreach($reports as $item) {
                echo "[new Date('".$item->created_at."'.substr(0,10)),parseInt('".$item->level."')],";
            //echo "[new Date('".$item->created_at."'),parseInt('".$item->level."')],";
        }
        @endphp
    ]);
    

    // Create a dashboard.
    var dashboard2 = new google.visualization.Dashboard(
            document.getElementById('dashboard2_div'));

    var dateRangeFilter = new google.visualization.ControlWrapper({
        'controlType': 'DateRangeFilter',
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
            'title': 'Level of pain',
            'pointSize': 5,
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
            echo "['".$item->description."',parseInt('".$item->level."'),new Date('".$item->created_at."'.substr(0,10)),'".$item->body_part."'],";
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
            'title': 'Pain description count',
            'pointSize': 5,
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
            echo "[new Date('".$item->created_at."'.substr(0,10)),parseInt('".$item->mood."')],";
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
            'title': 'Pain description count',
            'pointSize': 5,
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
            echo "['".$item->body_part."',parseInt('".$item->duration."'),parseFloat('".$item->average."'),new Date('".$item->created_at."'.substr(0,10))],";
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
            'title': 'Pain description count',
            'pointSize': 5,
        },
        'view': {'columns': [0,1,2]}
    });

     // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    dashboard.bind(filter, chart);

    dashboard.draw(data);
}
$('#chart-dropdown').on('change', function() {
    if(this.value == 1){
        $("#body_part_chart").css("display", "block");
        $('#description_chart').css("display", "none");
        $('#pain_level_chart').css("display", "none");
        $('#top_pain_chart').css("display", "none");
        $('#mood_chart').css("display", "none");
        $('#duration_chart').css("display", "none");
        $("#body-parts-chart-div").css("display", "block");
        $('#dashboard_div').css("display", "none");
        $('#dashboard2_div').css("display", "none");
        $('#dashboard3_div').css("display", "none");
        $('#dashboard4_div').css("display", "none");
        $('#dashboard5_div').css("display", "none");
    }else if(this.value == 2){
        $('#body-parts-chart-div').css("display", "none");
        $('#dashboard_div').css("display", "block");
        $('#dashboard2_div').css("display", "none");
        $('#dashboard3_div').css("display", "none");
        $('#dashboard4_div').css("display", "none");
        $('#dashboard5_div').css("display", "none");
        $("#body_part_chart").css("display", "none");
        $('#description_chart').css("display", "block");
        $('#pain_level_chart').css("display", "none");
        $('#top_pain_chart').css("display", "none");
        $('#mood_chart').css("display", "none");
        $('#duration_chart').css("display", "none");
    }else if(this.value == 3){
        $('#body-parts-chart-div').css("display", "none");
        $('#dashboard_div').css("display", "none");
        $('#dashboard2_div').css("display", "block");
        $('#dashboard3_div').css("display", "none");
        $('#dashboard4_div').css("display", "none");
        $('#dashboard5_div').css("display", "none");
        $("#body_part_chart").css("display", "none");
        $('#description_chart').css("display", "none");
        $('#pain_level_chart').css("display", "block");
        $('#top_pain_chart').css("display", "none");
        $('#mood_chart').css("display", "none");
        $('#duration_chart').css("display", "none");
    }else if(this.value == 4){
        $('#body-parts-chart-div').css("display", "none");
        $('#dashboard_div').css("display", "none");
        $('#dashboard2_div').css("display", "none");
        $('#dashboard3_div').css("display", "block");
        $('#dashboard4_div').css("display", "none");
        $('#dashboard5_div').css("display", "none");
        $("#body_part_chart").css("display", "none");
        $('#description_chart').css("display", "none");
        $('#pain_level_chart').css("display", "none");
        $('#top_pain_chart').css("display", "block");
        $('#mood_chart').css("display", "none");
        $('#duration_chart').css("display", "none");
    }else if(this.value == 5){
        $('#body-parts-chart-div').css("display", "none");
        $('#dashboard_div').css("display", "none");
        $('#dashboard2_div').css("display", "none");
        $('#dashboard3_div').css("display", "none");
        $('#dashboard4_div').css("display", "block");
        $('#dashboard5_div').css("display", "none");
        $("#body_part_chart").css("display", "none");
        $('#description_chart').css("display", "none");
        $('#pain_level_chart').css("display", "none");
        $('#top_pain_chart').css("display", "none");
        $('#mood_chart').css("display", "block");
        $('#duration_chart').css("display", "none");
    }else{
        $('#body-parts-chart-div').css("display", "none");
        $('#dashboard_div').css("display", "none");
        $('#dashboard2_div').css("display", "none");
        $('#dashboard3_div').css("display", "none");
        $('#dashboard4_div').css("display", "none");
        $('#dashboard5_div').css("display", "block");
        $("#body_part_chart").css("display", "none");
        $('#description_chart').css("display", "none");
        $('#pain_level_chart').css("display", "none");
        $('#top_pain_chart').css("display", "none");
        $('#mood_chart').css("display", "none");
        $('#duration_chart').css("display", "block");
    }
});
</script>