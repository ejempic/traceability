@extends('layouts.login')

@section('title', 'Blank')

@section('content')
    <div class="ibox-content">
        <div class="text-center">
            <img src="{{ URL::to('/images/logo.png') }}" alt="agrabah-logo" class="logo img-fluid mt-3" width="250">
        </div>
    </div>

    <section class="container">

        <div class="row mt-5">
            <div class="col-sm-4">
                <div class="wrapper wrapper-content text-center">
                    <h3 class="mb-0">Reference ID:</h3>
                    <h1 class="mt-0 mb-4">{{ $data->reference }}</h1>
                    {{ QrCode::size(200)->generate($data->url) }}
                </div>
            </div>
            <div class="col-sm-8">
                <div class="wrapper wrapper-content">
                    <div class="ibox-content ibox-heading">
                        <h3><i class="fa fa-user-o"></i> Trace Info</h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row feed-activity-list">

                            <div class="col-sm-6">
                                <div>
                                    <h3>Receiver:</h3>
                                    <span><i class="fa fa-user"></i> <strong>{{ $data->receiver->value_0 }}</strong></span><br>
                                    <span><i class="fa fa-mobile"></i> {{ $data->receiver->value_1 }}</span><br>
                                    <span><i class="fa fa-map-marker"></i> {{ $data->receiver->text_0 }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <h3>Dispatch:</h3>
                                    <span><i class="fa fa-user"></i> <strong>{{ $data->dispatch->value_0 }}</strong></span><br>
                                    <span><i class="fa fa-mobile"></i> {{ $data->dispatch->value_1 }}</span><br><br>
                                    <dl>
                                        <dd>Type: {{ $data->dispatch->value_2 }}</dd>
                                        <dd>Plate: {{ $data->dispatch->value_3 }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            @if(($data->trace == 'Delivered') || ($data->trace == 'Returned'))
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <h2>Completed</h2>
                                    </div>
                                </div>
                            @else
                                @switch($data->trace)
                                    @case('Arrive')
                                    <div class="col-sm-6">
                                        <button class="btn btn-block btn-success btn-action p-3" data-id="{{ $data->id }}" data-action="Delivered">DELIVERED</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-block btn-danger btn-action p-3" data-id="{{ $data->id }}" data-action="Returned">UNDELIVERABLE</button>
                                    </div>
                                    @break
                                    @default
                                    <div class="col-sm-12">
                                        <button class="btn btn-block btn-success btn-action p-3" data-id="{{ $data->id }}" data-action="{{ $data->trace }}">
                                            @switch($data->trace)
                                                @case('Loaded')
                                                Depart
                                                @break
                                                @case('Transit')
                                                Arrive
                                                @break
                                            @endswitch
                                        </button>
                                    </div>
                                @endswitch
                            @endif



                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="wrapper wrapper-content">

                </div>
            </div>
        </div>
    </section>


    <div class="modal inmodal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category="" data-variant="" data-bal="">
        <div id="modal-size">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save-btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    {{--{!! Html::style('') !!}--}}
    {!! Html::style('/css/template/plugins/sweetalert/sweetalert.css') !!}
@endsection

@section('scripts')
    {{--    {!! Html::script('') !!}--}}
        {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}
    <script>
        $(document).ready(function(){
            $(document).on('click', '.btn-action', function(){
                var id = $(this).data('id');
                let action;
                switch ($(this).data('action')){
                    case 'Loaded':
                        action = 'Depart';
                        break;
                    case 'Transit':
                        action = 'Transit';
                        break;
                    case 'Arrive':
                        action = 'Arrive';
                        break;
                    case 'Delivered':
                        action = 'Delivered';
                        break;
                    case 'Undeliverable':
                        action = 'Undeliverable';
                        break;
                }

                swal({
                    title: "Are you sure?",
                    text: "Your will not be able to undo this action!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false },
                function (isConfirm) {
                    if (isConfirm) {
                        $.get('{!! route('trace-update-status') !!}', {
                            id: id,
                            action: action
                        }, function(){
                            location.reload();
                        });
                    } else {
                        swal("Cancelled", "Trace unchanged", "error");
                    }
                });


            });

        });
    </script>
@endsection
