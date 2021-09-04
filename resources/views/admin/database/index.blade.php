
@extends('admin.master')

@section('title', 'Database Management')

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
            <div class="title-action">
{{--                <a href="#" class="btn btn-primary">This is action area</a>--}}
{{--                {{ settings('agrabah-mobile-number') }}--}}
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">

        @include('alerts.validation')
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-heading">
                        <div class="ibox-title">Truncate Tables</div>
                        <div class="ibox-tools">
                            <span class="text-muted small "><i class="text-danger fa fa-exclamation-triangle"></i> Note: Please back up database first if Production</span>&nbsp;
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form action="{!! route('database.truncate') !!}" method="post" id="form">
                        @csrf
                        <div class="form-group">
                            <div class="i-checks">
                                <label>{{ Form::checkbox('databases[]', 'loans', false) }}<i></i> Loans</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="i-checks">
                                <label>{{ Form::checkbox('databases[]', 'trace', false) }}<i></i> Trace</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="i-checks">
                                <label>{{ Form::checkbox('databases[]', 'wharf', false) }}<i></i> Wharfs</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="text-muted small "><i class="text-danger fa fa-exclamation-triangle"></i> Warning: Truncating users, removes their profiles/applications/details/loans as well.</span>&nbsp;
                            <div class="i-checks">
                                <label>{{ Form::checkbox('databases[]', 'users_except_superadmin', false) }}<i></i> Users except <b>superadmin@agrabah.ph</b></label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success">Excecute</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal inmodal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true" data-category="" data-variant="" data-bal="">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="padding: 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

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
    {!! Html::style('css/template/plugins/switchery/switchery.css') !!}
    <style>
        .form-group{
            margin-bottom: 0;
        }
    </style>
@endsection

@section('scripts')
    {{--    {!! Html::script('') !!}--}}
    <!-- Switchery -->
    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}
    {!! Html::script('js/template/plugins/switchery/switchery.js') !!}
    <script>

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });

        // var elem = document.querySelector('.js-switch');
        // var switchery = new Switchery(elem, { color: '#1AB394' });

        $(document).on('click', '.add_setting', function(){
            var empty_row = $('.empty_row');
            if(empty_row.length)
                empty_row.remove();
            var new_row = '<tr class="">'+
            '    <td width="30%"><input type="text" class="form-control" name="new_entry[name][]" ></td>'+
            '    <td><input type="text" class="form-control" name="new_entry[value][]"></td>'+
            '    <td width="10">'+
            '        <input type="checkbox" class="js-switch new_switches" name="new_entry[is_active][]"/>'+
            '    </td>'+
            '</tr>';
            $('.setting_tbody').append(new_row);

            var elems = Array.prototype.slice.call(document.querySelectorAll('.new_switches'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html);
            });
            $('.new_switches').removeClass('new_switches')
        });

        $(document).ready(function(){
            {{--var modal = $('#modal');--}}
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

        });
    </script>
@endsection
