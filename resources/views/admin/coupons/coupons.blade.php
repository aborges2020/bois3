@extends('layouts.adminLte')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Discount Coupons</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Discount Coupons</li>
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
                            <button type="button" name="create_record" id="create_record" class="btn btn-warning btn-sm"><i class="fas fa-plus-circle"></i> Add Coupom</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="coupons_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Code</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Quantity</th>
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
                            <label class="control-label col-md-4">Code</label>
                            <div class="col-md-8">
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Start Date</label>
                            <div class="col-md-8">
                                
                                <div class="form-check form-check-inline">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label class="control-label">aaaa/mm/dd</label>
                                            <input type="text" name="start_date" id="start_date" class="form-control" maxlength="10" size="20">
                                        </div>
                                        <div class="form-group col">
                                            <label class="control-label">Hours (0-23)</label>
                                            <input type="text" name="start_hours" id="start_hours" class="form-control" maxlength="2" size="2">
                                        </div>
                                        <div class="form-group col">
                                            <label class="control-label">Minutes (00-59)</label>
                                            <input type="text" name="start_minutes" id="start_minutes" class="form-control" maxlength="2" size="2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">End Date</label>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label class="control-label">aaaa/mm/dd</label>
                                            <input type="text" name="end_date" id="end_date" class="form-control" maxlength="10" size="20">
                                        </div>
                                        <div class="form-group col">
                                            <label class="control-label">Hours (0-23)</label>
                                            <input type="text" name="end_hours" id="end_hours" class="form-control" maxlength="2" size="2">
                                        </div>
                                        <div class="form-group col">
                                            <label class="control-label">Minutes (00-59)</label>
                                            <input type="text" name="end_minutes" id="end_minutes" class="form-control" maxlength="2" size="2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Type</label>
                            <div class="col-md-8">
                                {{-- <input type="text" name="type" id="type" class="form-control"> --}}
                                <select name="type" id="type">
                                    <option value="">Select</option>
                                    <option value="1">Money</option>
                                    <option value="2">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Value</label>
                            <div class="col-md-8">
                                <input type="text" name="value" id="value" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Quantity</label>
                            <div class="col-md-8">
                                <input type="text" name="quantity" id="quantity" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input checkboxActive" name="active" id="active">
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>
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
            var dt = $('#coupons_table').DataTable({
                // Order table
                order: [[ 0, "desc" ]],
                //stateSave: true,
                processing: false,
                serverSide: true,
                ajax: {
                    url: "/admin/coupons",
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
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'value',
                        name: 'value'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
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
                $('#data_form')[0].reset();
            });

            $('#data_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

                if($('#action').val() == 'Add')
                {
                    action_url = "/admin/coupons";
                }

                if($('#action').val() == 'Edit')
                {
                    action_url = "/admin/coupons/update";
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
                            $('#coupons_table').DataTable().ajax.reload();
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
                    url :"/admin/coupons/" + id + "/edit",
                    dataType:"json",
                    success:function(data)
                    {
                        $('#code').val(data.result.code);

                        var start_date = new Date(data.result.start_date);
                        var startHours = start_date.getHours();
                        var startMinutes = start_date.getMinutes();

                        $('#start_date').val(formatDate(start_date));
                        $('#start_hours').val(startHours);
                        $('#start_minutes').val(startMinutes);

                        var end_date = new Date(data.result.end_date);
                        var endHours = end_date.getHours();
                        var endMinutes = end_date.getMinutes();

                        $('#end_date').val(formatDate(end_date));
                        $('#end_hours').val(endHours);
                        $('#end_minutes').val(endMinutes);
                        
                        $('#type').val(data.result.type);
                        $('#value').val(data.result.value);
                        $('#quantity').val(data.result.quantity);
                        $('#active').val(data.result.active);
                        if(data.result.active == 1)
                        {
                            $('.checkboxActive').prop('checked', true);
                        }else
                        {
                            $('.checkboxActive').prop('checked', false);
                        }
                        $('#group_active').show();
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Edit Record');
                        $('#action_button').text('Edit');
                        $('#action').val('Edit');
                        $('#formModal').modal('show');
                    }
                })
            });

            function formatDate(date) 
            {
                var day = date.getDate();
                var month = date.getMonth();
                var year = date.getFullYear();
                return year + '/' + month + '/' + day;
            }
            
            // Delete data
            var id;
            $(document).on('click', '.delete', function(){
                id = $(this).attr('id');
                $('.modal-title').text('Confirmation');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function(){
                $.ajax({
                    url:"/admin/coupons/destroy/" + id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            toastr.success('Data has been deleted successfully');
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');		
                            $('#coupons_table').DataTable().ajax.reload();
                            //alert('Data Deleted');
                        }, 2000);
                    }
                })
            });
        });
    </script>
@endsection