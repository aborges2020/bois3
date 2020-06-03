@extends('layouts.adminLte')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                            <button type="button" name="create_record" id="create_record" class="btn btn-warning btn-sm"><i class="fas fa-plus-circle"></i> Add new product</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="products_table" class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Sold</th>
                                    <th>Qty</th>
                                    <th>Price</th>  
                                    <th>Active</th>
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
                            <label class="control-label col-md-4">Name : </label>
                            <div class="col-md-8">
                                <input type="text" name="productName" id="productName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Category id : </label>
                            <div class="col-md-8">
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">Select</option>
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id }}">{{ $row->categoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="group_slug">
                            <label class="control-label col-md-4">Slug : </label>
                            <div class="col-md-8">
                                <input type="text" name="slug" id="slug" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Description : </label>
                            <div class="col-md-8">
                                <input type="text" name="description" id="description" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Quantity : </label>
                            <div class="col-md-8">
                                <input type="text" name="quantity" id="quantity" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Price : </label>
                            <div class="col-md-8">
                                <input type="text" name="price" id="price" class="form-control">
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
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                </div>
            </div>
        </div>
    </div>    

@endsection

@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var dt = $('#products_table').DataTable({
                // Order table
                order: [[ 0, "desc" ]],
                //stateSave: true,

                processing: false,
                serverSide: true,
                ajax: {
                    url: "/admin/products",
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
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'productName',
                        name: 'productName'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'sold',
                        name: 'sold'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'active',
                        name: 'active'
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
                $('#group_slug').hide();
                $('#data_form')[0].reset();
            });

            $('#data_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

                if($('#action').val() == 'Add')
                {
                    action_url = "/admin/products";
                }

                if($('#action').val() == 'Edit')
                {
                    action_url = "/admin/products/update";
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
                            $('#products_table').DataTable().ajax.reload();
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
                    url :"/admin/products/" + id + "/edit",
                    dataType:"json",
                    success:function(data)
                    {
                        $('#category_id').val(data.result.category_id);
                        $('#productName').val(data.result.productName);
                        $('#quantity').val(data.result.quantity);
                        $('#price').val(data.result.price);
                        $('#description').val(data.result.description);
                        $('#slug').val(data.result.slug);
                        $('#image').val(data.result.image);
                        $('#active').val(data.result.active);
                        if(data.result.active == 1)
                        {
                            $('.checkboxActive').prop('checked', true);
                        }else
                        {
                            $('.checkboxActive').prop('checked', false);
                        }
                        $('#group_active').show();
                        $('#group_slug').show();
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
                    url:"/admin/products/destroy/" + id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            toastr.success('Data has been deleted successfully');
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');		
                            $('#products_table').DataTable().ajax.reload();
                            //alert('Data Deleted');
                        }, 2000);
                    }
                })
            });
        });
    </script>
@endsection