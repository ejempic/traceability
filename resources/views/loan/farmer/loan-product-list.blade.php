@extends(subdomain_name().'.master')

@section('title', 'Loan Products')

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
                <a href="#" class="btn btn-primary">This is action area</a>
            </div>
        </div>
    </div>

    <div id="app" class="wrapper wrapper-content">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="status">Loan Type</label>
                        <select name="type" class="form-control loan_input">
                            <option value="" selected>Select type</option>
                            @foreach($loanTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="col-form-label" for="product_name">Loan Term</label>
                        <input type="number" name="term" value="" placeholder="How many months?" class="form-control loan_input">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="col-form-label" for="price">Loanable Amount</label>
                        <input type="text" name="amount" value="" placeholder="Enter Amount" class="form-control money loan_input">
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <div class="loan-product-list project-list">
                            <table class="table table-hover">
                                <tbody>
                                <thead>
                                <tr>
                                    <th>Lending Partner</th>
                                    <th>Interest</th>
                                    <th>Term</th>
                                    <th class="text-right">Max Loan Amount</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td class="project-title">
                                        <a href="project_detail.html">Contract with Zender Company</a>
                                        <br/>
                                        <small>Created 14.08.2014</small>
                                    </td>
                                    <td>Interest</td>
                                    <td>Terms</td>
                                    <td>Amount</td>
                                    <td class="project-actions">
                                        <a href="#" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View </a>
                                        <a href="#" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
    {!! Html::script('/js/template/plugins/jqueryMask/jquery.mask.min.js') !!}
    {!! Html::script('/js/template/moment.js') !!}
    {!! Html::script('/js/template/numeral.js') !!}
    {{--    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}--}}
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}--}}
    {{--    {!! Html::script('/js/template/moment.js') !!}--}}
    <script>
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


            // $('.money').mask("#,##0.00", {reverse: true});

            getList(null, null, null);

            $(document).on('change keyup', '.loan_input', function(){
                getList($('select[name=type]').val(), $('input[name=term]').val(), $('input[name=amount]').val());
            });

            function getList(type, term, amount){
                console.log('type: '+ type);
                console.log('term: '+ term);
                console.log('amount: '+ numeral(amount).format('0'));
                var list = new Array();
                jQuery.ajaxSetup({async:false});
                $.get('{!! route('loan-product-list-get') !!}', {
                    type: type,
                    term: term,
                    amount: amount
                }, function(data){
                    console.log(data);
                    for(var a = 0; a < data.length; a++){
                        list.push('' +
                            '<tr>' +
                                '<td class="project-title">' +
                                    '<a href="#">'+ data[a].provider.profile.bank_name +'</a>' +
                                    '<br/>' +
                                    '<small>'+ data[a].type.display_name +'</small>' +
                                '</td>' +
                                '<td>'+ data[a].interest_rate +'%</td>' +
                                '<td>'+ data[a].duration +' day/s</td>' +
                                '<td class="text-right">'+ numeral(data[a].amount).format('0,0.00') +'</td>' +
                                '<td class="project-actions">' +
                                    '<a href="#" class="btn btn-white btn-sm"><i class="fa fa-search"></i> View </a>' +
                                    '<a href="#" class="btn btn-white btn-sm"><i class="fa fa-check"></i> Apply </a>' +
                                '</td>' +
                            '</tr>' +
                        '');
                    }
                });
                $('.loan-product-list').find('tbody').empty().append(list.join(''));
            }

        });
    </script>
@endsection
