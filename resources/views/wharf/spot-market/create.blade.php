@extends(subdomain_name().'.master')

@section('title', 'Add Listing')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@yield('title')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}">Lists</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@yield('title')</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <button type="button" class="btn btn-primary btn-action" data-action="store">Store</button>
            </div>
        </div>
    </div>

    <div id="app" class="wrapper wrapper-content">
        {{--        {{ Form::open(array('route'=>array('farmer.store'), array('id'=>'form'))) }}--}}
        {{--        {{ Form::open(array('route'=>array('farmer.store'), 'method'=>'post', 'id'=>'form')) }}--}}

        {{ Form::open(['route'=>'products.store','id'=>'form']) }}
        <div class="row">
            <div class="col-sm-12">
                @csrf
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Product Listing
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="summernote">
                                <h3>Product Details</h3>
                                Ang produktong ito ay dekalidad at matibay. It a galing sa pag sisikap nang ating mga natatangin magsasaka. Tangkilikin ang sariling atin.
                                <br/>
                                <br/>
                                <ul>
                                    <li>High quality</li>
                                    <li>Authentic</li>
                                    <li>Legit</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Original Price</label>
                            <input type="text" class="form-control" name="original_price">
                        </div>
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type="text" class="form-control" name="selling_price">
                        </div>
                    </div>
                </div>
            </div>


        </div>
        {{ Form::close() }}

        <div class="modal inmodal fade" id="modal" data-type="" tabindex="-1" role="dialog" aria-hidden="true"
             data-category="" data-variant="" data-bal="">
            <div id="modal-size">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 15px;">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                    class="sr-only">Close</span></button>
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
    </div>
@endsection


@section('styles')
    {!! Html::style('/css/template/plugins/iCheck/custom.css') !!}
    {!! Html::style('/css/template/plugins/summernote/summernote-bs4.css') !!}
    {{--{!! Html::style('') !!}--}}
    {{--    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    {{--    {!! Html::style('/css/template/plugins/sweetalert/sweetalert.css') !!}--}}
@endsection

@section('scripts')
    {!! Html::script('/js/template/plugins/iCheck/icheck.min.js') !!}
    {!! Html::script('/js/template/plugins/jqueryMask/jquery.mask.min.js') !!}
    {!! Html::script('/js/template/plugins/summernote/summernote-bs4.js') !!}
    {{--    {!! Html::script('') !!}--}}
    {{--    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}--}}
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}--}}
    {{--    {!! Html::script('/js/template/moment.js') !!}--}}
    <script>

        function numberWithCommas(x) {
            return x.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function populateSchedule() {
            var duration = $('#duration').val()
            var amount = $('#amount').val()
            var interest_rate = $('#interest_rate').val()
            var timing = $('#timing').val()
            var allowance = $('#allowance').val()
            var first_allowance = $('#first_allowance').val()

            $.get('{!! route('generate-schedule') !!}', {
                duration:duration,
                amount:amount,
                interest_rate:interest_rate,
                timing:timing,
                allowance:allowance,
                first_allowance:first_allowance,
            }, function(data){

                var table = '';
                var total = 0;
                for (let i = 0; i < data.length; i++) {
                    const datum = data[i];
                    table +='<tr>';
                    table +='<td>';
                    table += datum.date;
                    table +='</td>'
                    table +='<td class="text-right">';
                    table += numberWithCommas(datum.amount);
                    table +='</td>';
                    table +='</tr>';
                    total += datum.amount;
                }
                $('#total_loan_amount').html(numberWithCommas(total));
                $('#payment_schedule_review').empty().append(table);
                $('#payment_schedule_input').val(JSON.stringify(data))
            });
        }

        $(document).on('change, input', '.changeSchedule', function () {
            populateSchedule();
        });

        $(document).ready(function () {
            $('.summernote').summernote();

            populateSchedule();
            $('.money').mask("#,##0.00", {reverse: true});

            $(document).on('click', '.btn-action', function () {
                switch ($(this).data('action')) {
                    case 'store':
                        $('#form').submit();

                        // console.log($('input[name=four_ps]').val());
                        // console.log($('input[name=pwd]').val());
                        // console.log($('input[name=indigenous]').val());
                        // console.log($('input[name=livelihood]').val());
                        break;
                }
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });


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
