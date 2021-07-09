@extends('admin.master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <a href="{{ route('farmer.index') }}">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Farmers </span>
                                <h2 class="font-bold">{{ $farmer }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('inventory.index') }}">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-th-list fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Inventories </span>
                                <h2 class="font-bold">{{ $inventory }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{ route('trace.index') }}">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-truck fa-5x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Trace </span>
                                <h2 class="font-bold">{{ $trace }}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><strong>TRACE</strong> Reports</h5>
                        <div class="ibox-tools">
                            <div class="btn-group">
                                <button type="button" data-action="weekly" class="btn btn-xs btn-white btn-action active">Weekly</button>
                                <button type="button" data-action="monthly" class="btn btn-xs btn-white btn-action">Monthly</button>
                                <button type="button" data-action="annual" class="btn btn-xs btn-white btn-action">Annual</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
{{--                        <div>--}}
{{--                            <span class="float-right text-right">--}}
{{--                            <small>Average value of sales in the past month in: <strong>United states</strong></small>--}}
{{--                                <br/>--}}
{{--                                All sales: 162,862--}}
{{--                            </span>--}}
{{--                            <h3 class="font-bold no-margins">Half-year revenue margin</h3>--}}
{{--                            <small>Sales marketing.</small>--}}
{{--                        </div>--}}

                        <div class="m-t-sm">

                            <div class="row">
                                <div class="col-md-9">
                                    <div>
                                        <canvas id="lineChart" height="114"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <ul class="stat-list m-t-lg">
                                        <li>
                                            <h2 class="no-margins total">2,346</h2>
                                            <small>Total deliveries</small>
{{--                                            <div class="progress progress-mini">--}}
{{--                                                <div class="progress-bar" style="width: 48%;"></div>--}}
{{--                                            </div>--}}
                                        </li>
                                        <li>
                                            <h2 class="no-margins delivered">4,422</h2>
                                            <small>Delivered</small>
{{--                                            <div class="progress progress-mini">--}}
{{--                                                <div class="progress-bar" style="width: 60%;"></div>--}}
{{--                                            </div>--}}
                                        </li>
                                        <li>
                                            <h2 class="no-margins failed">4,422</h2>
                                            <small>Failed</small>
{{--                                            <div class="progress progress-mini">--}}
{{--                                                <div class="progress-bar" style="width: 60%;"></div>--}}
{{--                                            </div>--}}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

{{--                        <div class="m-t-md">--}}
{{--                            <small class="float-right"><i class="fa fa-clock-o"> </i>Update on 16.07.2015</small>--}}
{{--                            <small>--}}
{{--                                <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.--}}
{{--                            </small>--}}
{{--                        </div>--}}

                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
{{--    {!! Html::style('/css/template/plugins/morris/morris-0.4.3.min.css') !!}--}}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}
{{--    {!! Html::script('/js/template/plugins/peity/jquery.peity.min.js') !!}--}}

    <!-- Flot -->
    {!! Html::script('/js/template/plugins/flot/jquery.flot.js') !!}
    {!! Html::script('/js/template/plugins/flot/jquery.flot.tooltip.min.js') !!}
    {!! Html::script('/js/template/plugins/flot/jquery.flot.resize.js') !!}

    <!-- ChartJS-->
    {!! Html::script('/js/template/plugins/chartJs/Chart.min.js') !!}

    <script>
        $(document).ready(function() {

            $(document).on('click', '.btn-action', function(){
                $('.btn-action').removeClass('active');
                $(this).addClass('active')
                loadChart($(this).data('action'));
            });

            loadChart('weekly');

            function loadChart(action){
                console.log(action);
                var dataLength = null;
                var dataTotal = null;
                var dataSuccess = null;
                var dataFailed = null;
                jQuery.ajaxSetup({async:false});
                $.get('{!! route('trace-report') !!}', {
                    length: action
                }, function(data){
                    console.log(data);

                    // console.log(
                    //     data[1].reduce((a, b) => a + b, 0)
                    // )
                    // console.log(
                    //     data[2].reduce((a, b) => a + b, 0)
                    // )
                    // console.log(
                    //     data[3].reduce((a, b) => a + b, 0)
                    // )

                    $('.stat-list').find('.total').text(data[1].reduce((a, b) => a + b, 0));
                    $('.stat-list').find('.delivered').text(data[2].reduce((a, b) => a + b, 0));
                    $('.stat-list').find('.failed').text(data[3].reduce((a, b) => a + b, 0));

                    dataLength = data[0];
                    dataTotal = data[1];
                    dataSuccess = data[2];
                    dataFailed = data[3];
                });

                // console.log(dataLength);
                var lineData = {
                    labels: dataLength,
                    datasets: [
                        {
                            label: "Total Deliveries",
                            backgroundColor: "rgba(220,220,220,0.5)",
                            borderColor: "rgba(220,220,220,1)",
                            pointBackgroundColor: "rgba(220,220,220,1)",
                            pointBorderColor: "#fff",
                            data: dataTotal
                        },
                        {
                            label: "Delivery Success",
                            backgroundColor: "rgba(26,179,148,0.5)",
                            borderColor: "rgba(26,179,148,0.7)",
                            pointBackgroundColor: "rgba(26,179,148,1)",
                            pointBorderColor: "#fff",
                            data: dataSuccess
                        },
                        {
                            label: "Delivery Failed",
                            backgroundColor: "rgba(220,0,0,0.5)",
                            borderColor: "rgb(220,63,74)",
                            pointBackgroundColor: "rgb(220,118,118)",
                            pointBorderColor: "#fff",
                            data: dataFailed
                        }
                    ]
                };

                var lineOptions = {
                    responsive: true
                };

                var ctx = document.getElementById("lineChart").getContext("2d");
                new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

            }



        });
    </script>
@endsection
