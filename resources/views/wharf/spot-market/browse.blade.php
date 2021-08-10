@extends(subdomain_name().'.master')

@section('title', 'Spot Market')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>@yield('title')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@yield('title')</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                @include('wharf.spot-market.includes.cart_button')
            </div>
        </div>
    </div>

    <div id="app" class="wrapper wrapper-content">
        <div class="row">

            @forelse($spotMarketList as $data)
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box">
                        <a href="{{route('spot-market.show', $data->id)}}" class="">
                        <div class="product-imitation" style="background-image: url('{!! ($data->hasMedia('spot-market')? $data->getFirstMediaUrl('spot-market'):'')  !!}')">
{{--                            {{$data->name}}--}}
                        </div>
                        </a>
                        <div class="product-desc">
                                <span class="product-price">
                                   ₱{{$data->selling_price}}
                                </span>
                            <small class="text-muted d-none">Category</small>
                            <a href="{{route('spot-market.show', $data->id)}}" class="product-name"> {{$data->name}}</a>
                            <div class="small m-t-xs">
                                <h4>Highest Bid: ₱12,050</h4>
                                Following Bids
                                <ul>
                                    <li>₱12,000</li>
                                    <li>₱11,500</li>
                                </ul>
                            </div>
                            <div class="m-t text-right">
                                <a href="#" class="btn btn-xs btn-primary w-100 add-to-cart"  data-name="{{$data->name}}" data-id="{{$data->id}}">Bid</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12">
                    <h1 class="text-center w-100">No Listing Yet</h1>
                </div>
            @endforelse
        </div>
    </div>

    <div style="position: absolute; top: 20px; right: 20px;">

        <div class="toast toast1 toast-bootstrap toast-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa fa-cart-plus"> </i>
                <strong class="mr-auto m-l-sm">Add to Cart</strong>
{{--                <small>2 seconds ago</small>--}}
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <strong id="item_added_to_cart"></strong> has been added to Cart.
            </div>
        </div>

    </div>

@endsection


@section('styles')
    {!! Html::style('css/template/plugins/footable/footable.core.css') !!}
    {!! Html::style('css/template/plugins/toastr/toastr.min.css') !!}
    <style>
        .product-imitation{
            background-position: center center;
            background-size: contain;
            background-repeat: no-repeat;
        }
        .count-info .label{
            font-size: 12px;
            border-radius: 2em;
            top: 21px!important;
            padding: 4px 7px!important;
        }
    </style>
    {{--{!! Html::style('') !!}--}}
    {{--    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">--}}
    {{--    {!! Html::style('/css/template/plugins/sweetalert/sweetalert.css') !!}--}}
@endsection

@section('scripts')
    {!! Html::script('js/template/plugins/footable/footable.all.min.js') !!}
    {{--    {!! Html::script('') !!}--}}
    {{--    {!! Html::script(asset('vendor/datatables/buttons.server-side.js')) !!}--}}
    {{--    {!! $dataTable->scripts() !!}--}}
    {{--    {!! Html::script('/js/template/plugins/sweetalert/sweetalert.min.js') !!}--}}
    {{--    {!! Html::script('/js/template/moment.js') !!}--}}
    <script>
        $(document).ready(function(){
            $('.footable').footable();

            let toast1 = $('.toast1');
            toast1.toast({
                delay: 5000,
                animation: true
            });

            $('.add-to-cart').on('click', function(e){
                e.preventDefault();
                toast1.toast('show');
                var item = $(this).data('name');
                var itemId = $(this).data('id');
                addToCart(itemId);
                $('#item_added_to_cart').html(item);
            })
        });

        function addToCart(id){

            $.ajax({
                url: "{{route('spot-market.add_cart')}}",
                type:"POST",
                data:{
                    id:id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    $('#spot_market_cart_count').html(response);

                },
            });
            console.log(id)
        }
    </script>
@endsection
