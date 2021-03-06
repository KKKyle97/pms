<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="px-5 py-3 h-100">
    <div class="py-3 font-semi font-32" style="height:10%">
        <p class="m-0 p-0">Analysis</p>
    </div>
    <div class="backbone-panel px-5 py-3" style="height:80%">
        <div class="pb-5">
            <select name="chart-dropdown" id="chart-dropdown" class="form-control">
                <option value="1">Body Parts</option>
                <option value="2">Description</option>
                <option value="3">Pain Level</option>
                <option value="4">Top Pain</option>
                <option value="5">Mood</option>
                <option value="6">Pain Duration</option>
            </select>
        </div>
        @if ($reportsCount == 0)
            <p>No data yet</p>
        @else
        <div class="position-relative" style="height:80%">
            <div id="body-parts-chart-div" class="h-100 w-100 position-absolute"></div>
            <div id="dashboard_div" class=" w-100 position-absolute" style="height:90%">
                <!--Divs that will hold each control and chart-->
                <div id="filter_div"></div>
                <div id="chart_div" class=" h-100"></div>
            </div>

            <div id="dashboard2_div" class=" w-100 position-absolute" style="height:90%">
                <!--Divs that will hold each control and chart-->
                <div id="filter2_div" class="pb-3"></div>
                <div id="chart2_div" class=" h-100"></div>
            </div>

            <div id="dashboard3_div" class=" w-100 position-absolute" style="height:90%">
                <!--Divs that will hold each control and chart-->
                <div id="filter3_div"></div>
                <div id="filter3_1_div"></div>
                <div id="highestPainDataChart_div" class="h-100"></div>
            </div>

            <div id="dashboard4_div" class=" w-100 position-absolute" style="height:90%">
                <!--Divs that will hold each control and chart-->
                <div id="filter4_div"></div>
                <div id="chart4_div" class="h-100"></div>
            </div>

            <div id="dashboard5_div" class=" w-100 position-absolute" style="height:90%">
                <!--Divs that will hold each control and chart-->
                <div id="filter5_div"></div>
                <div id="chart5_div" class="h-100"></div>
            </div>
        </div>
        @endif
        

    </div>
</div>

@include('analysisjs')



@endsection