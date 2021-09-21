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
            <div class="col-sm-7">
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
                                <th>Email</th>
                                <th class="text-right"><i class="fa fa-cogs"></i></th>
                            </tr>
                            </thead>
                            <tbody id="tbody-users">
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right">
                                    <div class="btn-group text-right">
                                        <button class="btn-white btn btn-xs btn-action" data-action="user-edit"><i class="fa fa-pencil text-success"></i> edit</button>
                                        <button class="btn-white btn btn-xs btn-action" data-action="user-delete"><i class="fa fa-times text-danger"></i> delete</button>
                                    </div>
                                </td>
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
                        <button type="button" class="btn btn-success btn-xs float-right btn-action" data-action="edit-info">Edit</button>
                    </div>
                    <div class="ibox-content" id="bfar-info"></div>
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
                <div class="modal-body"> </div>
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


            $(document).on('click', '#modal-save-btn', function(){
                var action = modal.data('type');
                switch(action){
                    case 'create-user':
                        console.log(modal.find('input[name=name]').val());
                        console.log(modal.find('input[name=email]').val());
                        $.get('{!! route('store-user') !!}', {
                            name: modal.find('input[name=name]').val(),
                            email: modal.find('input[name=email]').val()
                        }, function(){
                            userList();
                            modal.modal('toggle');
                        });
                        break;
                    case 'update-user':
                        break;
                }
            });

            $(document).on('click', '.btn-action', function(){
                var init = $(this);
                var action = $(this).data('action');
                console.log(action);
                switch(action) {
                    case 'create-user':
                        modal.data('type', action);
                        modal.find('.modal-title').text('BFAR User Create');
                        modal.find('#modal-size').removeClass().addClass('modal-dialog modal-md');
                        modal.find('.modal-body').empty().append('' +
                            '<div class="form-group">' +
                                '<label>Name</label>' +
                                '<input type="text" name="name" class="form-control">' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label>Email</label>' +
                                '<input type="text" name="email" class="form-control">' +
                            '</div>' +
                        '');
                        modal.modal({backdrop: 'static', keyboard: false});
                        break;
                    case 'store-user':
                        break;
                    case 'update-user':
                        break;
                    case 'edit-info':
                        var mobile = '', email = '';
                        $.get('{!! route('bfar-get-info') !!}', function(data){
                            console.log(data);
                            if(data.profile.mobile !== null){
                                mobile = data.profile.mobile;
                            }
                            if(data.profile.landline !== null){
                                email = data.profile.landline;
                            }
                        });

                        init.closest('.ibox').find('.ibox-content').empty().append('' +
                            '<div class="form-group">' +
                                '<label>Mobile no.</label>' +
                                '<input type="text" name="mobile" value="'+ mobile +'" class="form-control">' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label>Email</label>' +
                                '<input type="text" name="email" value="'+ email +'" class="form-control">' +
                            '</div>' +
                        '');
                        init.data('action', 'update-info');
                        init.text('update');
                        break;
                    case 'update-info':
                        var box = $('#bfar-info');
                        $.get('{!! route('bfar-update-info') !!}', {
                            mobile: box.find('input[name=mobile]').val(),
                            email: box.find('input[name=email]').val()
                        }, function(){
                            bfarInfo();
                        });

                        init.data('action', 'edit-info');
                        init.text('edit');
                        break;
                }
            });

            userList();
            function userList(){
                var box = $('#tbody-users');
                $.get('{!! route('bfar-user-list') !!}', function(data){
                    if(data.length > 0){
                        box.empty();
                        for(var a = 0; a < data.length; a++){
                            box.append('' +
                                '<tr>' +
                                    '<td>'+ data[a].name +'</td>' +
                                    '<td>'+ data[a].email +'</td>' +
                                    '<td class="text-right">' +
                                        '<div class="btn-group text-right">' +
                                            '<button class="btn-white btn btn-xs btn-action" data-action="user-edit" data-id="'+ data[a].id +'"><i class="fa fa-pencil text-success"></i> edit</button>' +
                                            '<button class="btn-white btn btn-xs btn-action" data-action="user-delete" data-id="'+ data[a].id +'"><i class="fa fa-times text-danger"></i> delete</button>' +
                                        '</div>' +
                                    '</td>' +
                                '</tr>' +
                            '');
                        }
                    }
                });
            }

            bfarInfo();
            function bfarInfo(){
                var box = $('#bfar-info'), mobile = 'N/A', email = 'N/A';
                jQuery.ajaxSetup({
                    async: false
                });
                $.get('{!! route('bfar-get-info') !!}', function(data){
                    console.log(data.profile.mobile);
                    console.log(data.profile.landline);
                    if(data.profile.mobile !== null){
                        mobile = data.profile.mobile;
                    }
                    if(data.profile.landline !== null){
                        email = data.profile.landline;
                    }
                });
                box.empty().append('' +
                    '<div class="form-group">' +
                        '<label>Mobile no.</label>' +
                        '<h2 class="text-success"><strong>'+ mobile +'</strong></h2>' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label>Email</label>' +
                        '<h2 class="text-success"><strong>'+ email +'</strong></h2>' +
                    '</div>' +
                '');
            }
        });
    </script>
@endsection
