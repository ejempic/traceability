@extends('layouts.login')

@section('title', 'Blank')

@section('content')
    <div class="ibox-content">
        <div class="text-center">
            <h1>AGRABAH TRACEABILITY</h1>
        </div>
    </div>

    <section class="container">
        <div class="visible-print text-center">
            <img src="{{ $data->profile->qr_image_path }}" alt="{{ $data->profile->qr_image_path }}" class="img-fluid mt-3">
{{--            {!! QrCode::size(100)->generate($url); !!} <br><br>--}}
        </div>
    </section>

@endsection

@section('styles')
    {{--{!! Html::style('') !!}--}}
@endsection

@section('scripts')
    {{--    {!! Html::script('') !!}--}}
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
@endsection
