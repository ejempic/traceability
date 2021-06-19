@extends('layouts.login')

@section('title', 'Farmers Login')

@section('content')
    <div class="ibox-content">
        <div class="text-center">
            <img src="{{ URL::to('/images/logo.png') }}" alt="agrabah-logo" class="logo img-fluid mt-3" width="250">
        </div>
    </div>

    <section class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>CODE: <strong>{{ $trace->reference }}</strong></h2>
                    </div>
                    <div class="panel-body inspinia-timeline">
                        <h5>Timeline <small>info</small></h5>
                        @foreach($trace->timeline as $timeline)
                            <div class="timeline-item">
                                <div class="row">
                                    <div class="col-3 date">
                                        {{--                                        <i class="fa fa-file-text"></i>--}}
                                        {{ \Carbon\Carbon::parse($timeline->created_at)->toFormattedDateString() }}
                                        <br/>
                                        <small class="text-navy">{{ \Carbon\Carbon::parse($timeline->created_at)->diffForHumans(\Carbon\Carbon::now()) }}</small>
                                    </div>
                                    <div class="col-7 content">
                                        <p class="m-b-xs"><strong>{{ $timeline->value_0 }}</strong></p>
                                        <p>{{ $timeline->value_1 }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('styles')
    {{--{!! Html::style('') !!}--}}
@endsection

@section('scripts')
    {{--        {!! Html::script('') !!}--}}
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
