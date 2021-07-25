@extends(subdomain_name().'.master')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Dashboard')

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Monthly</span>
                        </div>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">40 886,200</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total income</small>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
