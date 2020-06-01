@extends('layouts.adminLte')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Config</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Config</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <form method="PUT" id="data_form">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-4" for="name">Enterprise name</label>
                                <div class="col-md-4">
                                <input type="text" name="name" id="name" class="form-control" value="{{ $config->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="address">Address</label>
                                <div class="col-md-4">
                                    <input type="text" name="address" id="address" class="form-control" value="{{ $config->address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="data_bank">Data bank</label>
                                <div class="col-md-4">
                                    <input type="text" name="data_bank" id="data_bank" class="form-control" value="{{ $config->data_bank }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="email">E-mail</label>
                                <div class="col-md-4">
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $config->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="facebook">Facebook</label>
                                <div class="col-md-4">
                                    <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $config->facebook }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="instagram">Instagram</label>
                                <div class="col-md-4">
                                    <input type="text" name="instagram" id="instagram" class="form-control" value="{{ $config->instagram }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="telephone">Telephone</label>
                                <div class="col-md-4">
                                    <input type="text" name="telephone" id="action_button" class="form-control" value="{{ $config->telephone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#data_form').on('submit', function(event){
                event.preventDefault();

                $.ajax({
                    url: "/admin/config/update",
                    method:"PUT",
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            toastr.success('Data has been updated successfully');
                        }
                    },
                    error: function () {
                        console.log('Error!');
                    }
                });
            });
        });
    </script>
@endsection