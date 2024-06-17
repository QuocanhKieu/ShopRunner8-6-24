@php use App\Utilities\Constant as Constant @endphp

@foreach($orders as $order)
    @php
        //                                    dd($order);
        $orderDetail = $order->orderDetails->first();

        $user = $order->user;
        //                                        $voucher = $order->voucher;
        //                                        $shippingInfo = $order->shippingInfo;
        $orderId = $order->id;
        $name = $order->first_name.' '.$order->last_name;
        //                                        $subTotal = $orderDetail->sub_total_amount;//tiền hàng
        //                                        $totalDiscount = $order->total_discount ?? 0;
        //                                        $deliveryFee = $order->delivery_fee ?? 0;
        $paymentType = $order->payment_type;
        $phone = $order->phone;
        $totalAmount = $orderDetail->total??0;
        //                                        $pendingPayment = $order->pending_payment ?? 0;
        //                                        $paymentStatus = $order->payment_status ?? '';
        $orderStatus = $order->status ?? '';
        $paymentStatus = $order->payment_status ?? '';
        $createdAt = $order->created_at->format('H:i d/m/Y');
    @endphp
    <tr>
        <td style="width:auto;">
                                            <span style="position: relative">
                                            {{ $orderId }}
                                                {{--                                                @if(trim($order->note??''))--}}
                                                {{--                                                    <a class="orderNoteDisplay" id="orderNoteDisplay{{$order->id}}"--}}
                                                {{--                                                       title="Customer Note"--}}
                                                {{--                                                       href="javascript:void(0)"--}}
                                                {{--                                                       onclick="displayOrderNote(this, {{$order->id}})"><i--}}
                                                {{--                                                            class="fas fa-comment-alt"></i></a>--}}
                                                {{--                                                @endif--}}
                                            </span>
        </td>
        {{--                                                    <td>--}}
        {{--                                                        {{ $user->id }}--}}
        {{--                                                    </td>--}}
        <td>{{$name}}</td>
        <td class="phone">{{$phone}}</td>
        <td style="width:10%;">
            $ {{$totalAmount}}
        </td>
        {{--                                                    <td>{{$paymentType}}</td>--}}
        <td>
            <div class="paymentSta"
                 style="color:{{$paymentStatus == 1 ? '#373434;' : '#01a935' }}"
            >
                {{Constant::$PAYMENT_STATUS[$paymentStatus]}}
            </div>

        </td>
        <td>
            <div class="paymentSta"
                 style="color:{{Constant::STATUSCOLORS[$orderStatus]}}; font-size: 1.1em"
            >
                {{Constant::$ORDER_STATUS[$orderStatus]}}
            </div>
        </td>
        <td>{{ $createdAt }}</td>
        <td>
            {{--                                                        <div class="dropdown" style=" margin-bottom: 5px; margin-right: 5px">--}}
            {{--                                                            <button class="btn btn-secondary dropdown-toggle" type="button"--}}
            {{--                                                                    id="dropdownMenuButton" data-toggle="dropdown"--}}
            {{--                                                                    aria-haspopup="true" aria-expanded="false">--}}
            {{--                                                                Actions--}}
            {{--                                                            </button>--}}
            {{--                                                            <div class="dropdown-menu dropdown-menu-right"--}}
            {{--                                                                 aria-labelledby="dropdownMenuButton"--}}
            {{--                                                                 id="actionOptions_{{$order->id}}">--}}
            <a class=""
               href="{{route('orders.orderDetails',['order'=> $order->id])}}"><i
                    class="fas fa-eye"></i>Details</a>

            {{--                                                            </div>--}}
            {{--                                                        </div>--}}
        </td>
    </tr>
@endforeach
