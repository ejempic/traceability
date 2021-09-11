@extends('admin.master')

@section('title', 'BFAR Settings')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@yield('title')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="\">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@yield('title')</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
{{--            <div class="title-action">--}}
{{--                <a href="#" class="btn btn-primary">This is action area</a>--}}
{{--            </div>--}}
        </div>
    </div>

    <div id="app" class="wrapper wrapper-content">

        <div class="row">
            <div class="col-sm-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title p-2">
                        <h5>Users</h5>
                        <button type="button" class="btn btn-success btn-xs float-right btn-action" data-action="create-user">Create</button>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive table-borderless">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title p-2">
                        <h5>BFAR Information</h5>
                        <button type="button" class="btn btn-success btn-xs float-right">Create</button>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label>Mobile no.</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal inmodal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category="" data-variant="" data-bal="">
        <div id="modal-size">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Position / Title</label>
                        <input type="text" name="position" class="form-control">
                    </div>
                </div>
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
    {{--    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    {{--    {!! Html::style('/css/template/plugins/sweetalert/sweetalert.css') !!}--}}
@endsection

@section('scripts')
    {{--    {!! Html::script('') !!}--}}
    {{--    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}--}}
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}--}}
    {{--    {!! Html::script('/js/template/moment.js') !!}--}}
    <script>
        $(document).ready(function(){
            var modal = $('#modal');
            {{--$(document).on('click', '', function(){--}}
            {{--    modal.modal({backdrop: 'static', keyboard: false});--}}
            {{--    modal.modal('toggle');--}}
            {{--});--}}

            {{-- var table = $('#table').DataTable({--}}
            {{--     processing: true,--}}
            {{--     serverSide: true,--}}
            {{--     ajax: {--}}
            {{--         url: '{!! route('') !!}',--}}
            {{--         data: function (d) {--}}
            {{--             d.branch_id = '';--}}
            {{--         }--}}
            {{--     },--}}
            {{--     columnDefs: [--}}
            {{--         { className: "text-right", "targets": [ 0 ] }--}}
            {{--     ],--}}
            {{--     columns: [--}}
            {{--         { data: 'name', name: 'name' },--}}
            {{--         { data: 'action', name: 'action' }--}}
            {{--     ]--}}
            {{-- });--}}

            {{--table.ajax.reload();--}}

            $(document).on('click', '.btn-action', function(){
                switch($(this).data('action')) {
                    case 'create-user':
                        modal.find('.modal-title').text('BFAR User Create');
                        modal.find('#modal-size').removeClass().addClass('modal-dialog modal-md');
                        modal.modal({backdrop: 'static', keyboard: false});
                        break;
                    case 'edit-info':
                        break;
                    case 'update-info':
                        break;
                }
            });

        });
    </script>
@endsection
