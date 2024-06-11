@extends('admin.layouts.admin')
@section('title')
    <title>Danh Sách Đơn Hàng</title>
@endsection
@section('this-css')
    <link rel="stylesheet" href="{{asset('admins/css/select2.min.css')}}">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        .deliveryFeeInput {
            max-width: 90px; padding-block: 0;
            height: auto !important;
        }
    </style>
@endsection
@section('content')
    @php
//        $ORDERS_STATUSES = App\Constants\OrderConstants::ORDERSSTATUSES;
//        $PAYMENT_STATUSES = App\Constants\OrderConstants::PAYMENTSTATUSES;
//        $STATUS_COLORS = App\Constants\OrderConstants::STATUSCOLORS;
//    dd($orderDetails->latest()->get());
    @endphp
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
{{--        <div style="display: flex; justify-content: end" >    {{(explode('.',request()->route()->getName())[0]). '.' .'search'}}--}}
        @include('admin.partials.content-header',['name' => 'Danh Sách Orders', 'key' => 'Chi tiết đơn hàng','url' => route('orders')])
{{--            breadCrumb--}}
        <div class="content">
            <div class="container-fluid ">
                <div class="row order_details">
                    <div class="div col-md-12">
                        <div class="card">
                            <h2 class="">ID Đơn hàng: #{{$order->id}}</h2>
                            <div class="row">
                                <div class="div col-md-12">
                                <h2>Thông tin Khách Hàng và Địa Chỉ Giao Hàng</h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">user_id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">company_name</th>
                                        <th scope="col">country</th>
                                        <th scope="col">street_address</th>
                                        <th scope="col">postcode_zip</th>
                                        <th scope="col">town_city</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$order->user->id}}</td>
                                            <td>{{$order->first_name.' '.$order->last_name}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td>{{$order->email}}</td>
                                            <td>{{$order->company_name}}</td>
                                            <td>{{$order->country}}</td>
                                            <td>{{$order->street_address}}</td>
                                            <td>{{$order->postcode_zip}}</td>
                                            <td>{{$order->town_city}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <hr>
                                    <h2>Thông tin thêm của Đơn Hàng</h2>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">payment_type</th>
                                            <th scope="col">shipping_method</th>
                                            <th scope="col">status</th>
                                            <th scope="col">note</th>
                                            <th scope="col">created_at</th>
                                            <th scope="col">Shipping fee</th>
                                            <th scope="col">Total quantity</th>
                                            <th scope="col">Sub Total Amount</th>
                                            <th scope="col">Total Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{$order->payment_type}}</td>
                                            <td>{{$order->shipping_method}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->note}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>$ {{$shippingFee}}</td>
                                            <td> {{$totalQuantity}}</td>
                                            <td>$ {{$totalAmount}} đ</td>
                                            <td>$ {{$total}} </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h2>Thông tin Sản Phẩm</h2>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">product_id </th>
                                            <th scope="col">product_image</th>
                                            <th scope="col">product_name</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">price</th>
                                            <th scope="col">total_price</th>
                                            <th scope="col">coupon</th>
                                        </tr>
                                        </thead>
                                        <tbody>
{{--                                        @php--}}
{{--                                                    dd($orderDetails->latest()->get());--}}

{{--                                        @endphp--}}
                                            @foreach($orderDetails as $key => $orderDetail)
                                                @php
                                                        $product = \App\Models\Product::find($orderDetail->product_id);
                                                        $thumbImgPath = $product->productImages()->first()->path;
                                                        $size = $orderDetail->size;
                                                        $color = $orderDetail->color;
                                                        $coupon = $orderDetail->coupon;
                                                @endphp
                                                <tr>
                                                    <td>{{$orderDetail->product_id}}</td>
                                                    <td><img src="{{asset("front/img/product/$thumbImgPath")}}" style="max-width:75px"></td>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$orderDetail->size}}</td>
                                                    <td>{{$orderDetail->color}}</td>
                                                    <td>{{$orderDetail->qty}}</td>
                                                    <td>$ {{$orderDetail->amount}}</td>
                                                    <td>$ {{$orderDetail->qty*$orderDetail->amount}}</td>
                                                    <td>$ {{$orderDetail->coupon??0}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        </div>
@endsection
@section('this-js')
    <script type="text/javascript">

    </script>
@endsection





