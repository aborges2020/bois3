@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h2>Last Orders</h2>
            
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Shipping</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $row)
                        <tr data-toggle="collapse" data-target="#details_{{ $row->id }}" class="clickable collapse-row collapsed">
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->status->name }}</td>
                            <td>{{ $row->payment->name }}</td>
                            <td>{{ $row->shipping->name }}</td>
                            <td>#</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="7">
                                <div id="details_{{ $row->id }}" class="collapse">Hidden by default</div>
                            </td>
                        </tr> --}}
                        <tr id="details_{{ $row->id }}" class="collapse">
                            <td colspan="7">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Resume</strong><br>
                                        <strong>Shipping Cost: </strong> {{ $row->shipping_value }} $<br>
                                        <strong>Coupom code: </strong> {{ $row->coupom['code'] }} | <strong>Discount: </strong> {{ $row->discount_value }} $<br>
                                        <strong>Total Order: </strong> {{ $row->total }} $<br>
                                        <strong>Save PDF file</strong> | <strong>Send to e-mail</strong> | <strong>Print </strong><br>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        @if ($row->status_id == 1)
                                            <p class="text-danger">
                                                <strong>How to make your payment</strong><br>
                                                Please transfer the total amount of your order to our bank account.<br>
                                                Bank details are:<br>
                                                {{ $configs->data_bank }}<br>
                                                <a href="{{ route('my.orders.details', ['id' => $row->id]) }}">Details</a><br>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Products</strong><br>
                                        {{-- {{ var_dump($row->items) }} --}}
                                        <ul>
                                            @foreach ($row->items as $item)
                                                {{-- {{ var_dump($item->product_id) }} --}}
                                                
                                        <li>Qty: {{ $item->quantity }} - {{ $item->products[0]['productName'] }} - {{ $item->price }} $<br>    </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Installments</strong><br>
                                        <ul>
                                            @foreach ($row->installments as $installment)
                                                <li>{{ $installment->number }}) Value: {{ $installment->value }} $ - {{ $installment->status['name'] }} - Due Date: {{ $installment->due_date }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2>Order History</h2>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Shipping</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordersHistory as $row)
                        <tr data-toggle="collapse" data-target="#details_{{ $row->id }}" class="clickable collapse-row collapsed">
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->status->name }}</td>
                            <td>{{ $row->payment->name }}</td>
                            <td>{{ $row->shipping->name }}</td>
                            <td>#</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="7">
                                <div id="details_{{ $row->id }}" class="collapse">Hidden by default</div>
                            </td>
                        </tr> --}}
                        <tr id="details_{{ $row->id }}" class="collapse">
                            <td colspan="7">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Resume</strong><br>
                                        <strong>Shipping Cost: </strong> {{ $row->shipping_value }} $<br>
                                        <strong>Coupom code: </strong> {{ $row->coupom['code'] }} | <strong>Discount: </strong> {{ $row->discount_value }} $<br>
                                        <strong>Total Order: </strong> {{ $row->total }} $<br>
                                        <strong>Save PDF file</strong> | <strong>Send to e-mail</strong> | <strong>Print </strong><br>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        @if ($row->payment_id <= 1)
                                            <strong>How to make your payment</strong><br>
                                            by transfer...<br>
                                        @endif
                                        
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Products</strong><br>
                                        {{-- {{ var_dump($row->items) }} --}}
                                        <ul>
                                            @foreach ($row->items as $item)
                                                {{-- {{ var_dump($item->product_id) }} --}}
                                                
                                        <li>Qty: {{ $item->quantity }} - {{ $item->products[0]['productName'] }} - {{ $item->price }} $<br>    </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <strong>Installments</strong><br>
                                        <ul>
                                            @foreach ($row->installments as $installment)
                                                <li>{{ $installment->number }}) Value: {{ $installment->value }} $ - {{ $installment->status['name'] }} - Due Date: {{ $installment->due_date }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">My Orders</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            You are logged in!
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
