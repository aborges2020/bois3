@extends('layouts.adminLte')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stocks</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Stocks</li>
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
                    <div class="card-header">
                        <h3 class="card-title float-sm-right">
                            <button type="button" name="create_record" id="create_record" class="btn btn-warning btn-sm"><i class="fas fa-plus-circle"></i> Add Stock</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="stocks_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Supplier</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    {{-- <th>Store</th>
                                    <th>Employee</th> --}}
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
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

    {{-- Modal Add ou Edit --}}
    <div id="formModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="data_form" class="form-horizontal">
                    @csrf
                    <div class="modal-body">
                        <span id="form_result"></span>
                        <div class="form-group">
                            <label class="control-label col-md-4">Supplier</label>
                            <div class="col-md-8">
                                <input type="text" name="supplier_id" id="supplier_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Payment</label>
                            <div class="col-md-8">
                                <input type="text" name="payment_method_id" id="payment_method_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Status</label>
                            <div class="col-md-8">
                                <input type="text" name="payment_status_id" id="payment_status_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Total</label>
                            <div class="col-md-8">
                                <input type="text" name="total" id="total" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Store</label>
                            <div class="col-md-8">
                                <input type="text" name="store_id" id="store_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Employee</label>
                            <div class="col-md-8">
                                <input type="text" name="employee_id" id="employee_id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" value="Add">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="action_button" id="action_button" class="btn btn-primary" /><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- Modal delete --}}
    <div id="confirmModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger"><i class="fas fa-check"></i> OK</button>
                </div>
            </div>
        </div>
    </div>    

@endsection

@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var dt = $('#stocks_table').DataTable({
                // Order table
                order: [[ 0, "desc" ]],
                //stateSave: true,
                processing: false,
                serverSide: true,
                ajax: {
                    url: "/admin/stocks",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        //visible: false,
                        //searchable: false,
                        //'orderable: false,
                        //'targets': 0
                    },
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    // {
                    //     data: 'store_id',
                    //     name: 'store_id'
                    // },
                    // {
                    //     data: 'employee_id',
                    //     name: 'employee_id'
                    // },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });
            
            // Add data
            $('#create_record').click(function(){
                $('.modal-title').text('Add New Record');
                $('#action_button').text('Add');
                $('#action').val('Add');
                $('#formModal').modal('show');
                $('#group_active').hide();
                $('#data_form')[0].reset();
            });

            $('#data_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

                if($('#action').val() == 'Add')
                {
                    action_url = "/admin/stocks";
                }

                if($('#action').val() == 'Edit')
                {
                    action_url = "/admin/stocks/update";
                }

                $.ajax({
                    url: action_url,
                    method:"POST",
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
                            if($('#action').val() == 'Add')
                            {
                                toastr.success('Data has been created successfully');
                            }
                            if($('#action').val() == 'Edit')
                            {
                                toastr.success('Data has been updated successfully');
                            }
                            $('#data_form')[0].reset();
                            $('#formModal').modal('hide');
                            $('#stocks_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });

            // Edit data
            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url :"/admin/stocks/" + id + "/edit",
                    dataType:"json",
                    success:function(data)
                    {
                        $('#supplier_id').val(data.result.supplier_id);
                        $('#payment_method_id').val(data.result.payment_method_id);
                        $('#payment_status_id').val(data.result.payment_status_id);
                        $('#total').val(data.result.total);
                        $('#store_id').val(data.result.store_id);
                        $('#employee_id').val(data.result.employee_id);
                        
                        $('#group_active').show();
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Edit Record');
                        $('#action_button').text('Edit');
                        $('#action').val('Edit');
                        $('#formModal').modal('show');
                    }
                })
            });

            // Delete data
            var id;
            $(document).on('click', '.delete', function(){
                id = $(this).attr('id');
                $('.modal-title').text('Confirmation');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
                $.ajax({
                    url:"/admin/stocks/destroy/" + id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            toastr.success('Data has been deleted successfully');
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');		
                            $('#stocks_table').DataTable().ajax.reload();
                            //alert('Data Deleted');
                        }, 2000);
                    }
                })
            });
        });
    </script>
@endsection