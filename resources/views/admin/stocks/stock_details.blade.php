@extends('layouts.adminLte')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Stock Show</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Stock</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-3"><strong>id:</strong> {{ $data->id }}</div>
                                <div class="col-sm-12 col-md-3"><strong>Name :</strong> {{ $data->supplier['name'] }} / {{ $data->supplier['contact_name'] }}</div>
                                <div class="col-sm-12 col-md-3"><strong>E-mail :</strong> {{ $data->supplier['email'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Total</th>
                                        <th>Employee</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>
                                        @if($data->status_id = 1)
                                            <span class="badge badge-warning">{{ $data->status->name }}</span>
                                        @elseif($data->status_id = 2)
                                            <span class="badge badge-info">{{ $data->status->name }}</span>
                                        @elseif($data->status_id = 3)
                                            <span class="badge badge-danger">{{ $data->status->name }}</span>
                                        @elseif($data->status_id = 4)
                                            <span class="badge badge-success">{{ $data->status->name }}</span>    
                                        @endif
                                    </td>
                                    <td>{{ $data->payment['name'] }}</td>
                                    <td>{{ $data->total }}</td>
                                    <td>{{ $data->employee['id'] }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Items ?</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->items as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->products[0]['productName'] }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>{{ $row->price }} $</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Installments</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Value</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4">no data available!</td>
                                    </tr>
                                    {{-- @foreach ($data->installments as $row)
                                        <tr>
                                            <td>{{ $row->number }}</td>
                                            <td>{{ $row->value }} $</td>
                                            <td>{{ $row->status['name'] }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/admin/stocks') }}" class="btn btn-secondary btn-sm"><i class="fas fa-angle-double-left"></i> Back to Stocks</a>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('js_scripts')

@endsection
