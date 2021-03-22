<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="header d-flex justify-content-center align-items-center">
    <p class="font-22 font-semi m-0 p-0">Patient Analysis</p>
</div>
<div class="middle patient-list py-3">
    <div class="py-3 position-relative" style="height:75vh; overflow:auto">
        <div class="pb-3">
            <select name="chart-dropdown" id="chart-dropdown" class="form-control">
                <option value="1">The Number Of Pain According To Different Body Parts</option>
                <option value="2">The Number Of Pain According To The Description Of Pain</option>
                <option value="3">The Changes Of Pain Level According To Time</option>
                <option value="4">The Highest Level Of Pain According to The Description Of Pain</option>
                <option value="5">The Changes Of Mood According To Time</option>
                <option value="6">The Highest And Average Pain Duration According To Time</option>
            </select>
        </div>
        <hr/>
        @if ($reportsCount == 0)
            <p>No data yet</p>
        @else
        <div>
            <div id="body_part_chart">
                <p class="font-semi font-18">The Number Of Pain According To Different Body Parts</p>
                <p>This chart is describing about the the number of pains he/she is having according to the body parts listed in the chart.</p>
            </div>
            <div id="description_chart">
                <p class="font-semi font-18">The Number Of Pain According To The Description Of Pain</p>
                <p class="m-0">This chart is describing about the the number of pains he/she is having according to the description of pain. 
                    The filter below provides option to specify the description in different body parts.</p>
                <p>E.g. If Select 'head' in filter, the chart will display the description of pain in 'head' only.</p>
            </div>
            <div id="pain_level_chart">
                <p class="font-semi font-18">The Changes Of Pain Level According To Time</p>
                <p>This chart is describing about all the pain level he/she reported over time. The filter below allows user to specify the range of date to display the pain level between 2 specific date.</p>
            </div>
            <div id="top_pain_chart">
                <p class="font-semi font-18">The Highest Level Of Pain According to The Description Of Pain</p>
                <p>This chart is describing about all highest value of pain level based on the description of pain and body part. The filter below allows user to specify the range of date to display the highest pain level between 2 specific date.</p>
            </div>
            <div id="mood_chart">
                <p class="font-semi font-18">The Changes Of Mood According To Time</p>
                <p>This chart is describing about mood he/she reported over time. The filter below allows user to specify the range of date to display the mood level between 2 specific date.</p>
                <p>0: Awful, 1: Bad, 2: Not Good, 3: Ok, 4: Good, 5: Great</p>
            </div>
            <div id="duration_chart">
                <p class="font-semi font-18">The Highest And Average Pain Duration According To Time</p>
                <p>This chart is describing about pain duration he/she reported over time. The filter below allows user to specify the range of date to display the pain duration between 2 specific date.</p>
            </div>
        </div>
        
    
        <div id="body-parts-chart-div" class="w-75 h-50 position-absolute" style="left:10%">
        </div>
        
        <div id="dashboard_div" class=" w-75 h-50 position-absolute" style="left:20%">
            <!--Divs that will hold each control and chart-->
            <div id="filter_div" class="w-75"></div>
            <div id="chart_div" class=" h-100"></div>
        </div>
    
        <div id="dashboard2_div" class=" w-75  h-50 position-absolute" style="left:10%">
            <!--Divs that will hold each control and chart-->
            <div id="filter2_div" class="pb-3 w-75"></div>
            <div id="chart2_div" class=" h-100"></div>
        </div>
    
        <div id="dashboard3_div" class=" w-75  h-50 position-absolute" style="left:10%">
            <!--Divs that will hold each control and chart-->
            <div id="filter3_div" class="w-75"></div>
            <div id="filter3_1_div" class="w-75"></div>
            <div id="highestPainDataChart_div" class="h-100"></div>
        </div>
    
        <div id="dashboard4_div" class=" w-75  h-50 position-absolute" style="left:10%">
            <!--Divs that will hold each control and chart-->
            <div id="filter4_div" class="w-75"></div>
            <div id="chart4_div" class="h-100"></div>
        </div>
    
        <div id="dashboard5_div" class=" w-75  h-50 position-absolute" style="left:10%">
            <!--Divs that will hold each control and chart-->
            <div id="filter5_div" class="w-75"></div>
            <div id="chart5_div" class="h-100"></div>
        </div>
        @endif
        
    
    </div>
</div>

<div class="footer d-flex justify-content-center align-items-center">
    <p class="font-14 m-0 p-0">Copyright 2021</p>
</div>


@include('analysisjs')



@endsection