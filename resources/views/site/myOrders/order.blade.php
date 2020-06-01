@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Order Details</h2>
            <hr>
            
            @if($order->status_id == 1)
                <p>
                    <strong>Info to make payment</strong><br>
                    Please transfer the total amount of your order to our bank account.<br>
                    Bank details are: <br>
                    {{ $configs->data_bank }}
                </p>
            @endif
            
            <p>
                <strong>Order number: {{ $order->id }}<br>
                <strong>Order status: {{ $order->status->name }} <br>
                <strong>Payment: </strong>{{ $order->payment->name }}<br>
                <strong>Shipping: </strong>{{ $order->shipping->name }}<br>
                
                @if($order->shipping_value > 0)
                    <strong>Shipping cost: </strong>{{ $order->shipping_value }} $<br>
                @endif
                
                @if(isset($order->coupom_id))
                    <strong>Discount: </strong>{{ $order->discount_value }} $<br>
                @endif

                <strong>Total: </strong>{{ $order->total }} $<br>
            </p>

            <p>
                <strong>Order Items</strong><br>
                @foreach ($order->items as $item)
                    {{ $item->quantity }} - {{ $item->products[0]['productName'] }} - {{ $item->price }} $<br>
                @endforeach
            </p>

            {{-- <p>
                <strong>Order Installments</strong><br>
                ...
            </p> --}}
            <a href="{{ route('my.orders') }}" class="btn btn-secondary"><i class="fas fa-angle-double-left"></i> Back to My Orders</a>
        </div>
    </div>
@endsection
