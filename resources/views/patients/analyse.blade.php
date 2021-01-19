<?php
use App\Common;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('All Patients') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p>Analysis</p>
                    <div id="body-parts-chart-div"></div>
                    <div id="dashboard_div">
                        <!--Divs that will hold each control and chart-->
                        <div id="filter_div"></div>
                        <div id="chart_div"></div>
                    </div>

                    <div id="dashboard2_div">
                        <!--Divs that will hold each control and chart-->
                        <div id="filter2_div"></div>
                        <div id="chart2_div"></div>
                    </div>

                    <div id="dashboard3_div">
                        <!--Divs that will hold each control and chart-->
                        <div id="filter3_div"></div>
                        <div id="filter3_1_div"></div>
                        <div id="highestPainDataChart_div"></div>
                    </div>

                    <div id="dashboard4_div">
                        <!--Divs that will hold each control and chart-->
                        <div id="filter4_div"></div>
                        <div id="chart4_div"></div>
                    </div>

                    <div id="dashboard5_div">
                        <!--Divs that will hold each control and chart-->
                        <div id="filter5_div"></div>
                        <div id="chart5_div"></div>
                    </div>

                    @include('analysisjs')
                </div>
            </div>
        </div>
    </div>
</div>


@endsection