@extends('layouts.adminLte')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employees</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Employees</li>
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
                            <button type="button" name="create_record" id="create_record" class="btn btn-warning btn-sm"><i class="fas fa-plus-circle"></i> Add Employee</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="employees_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>E-mail</th>
                                    <th>Position</th>
                                    <th>Role</th>
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
                            <label class="control-label col-md-4">First Name : </label>
                            <div class="col-md-8">
                                <input type="text" name="firstName" id="firstName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Last Name</label>
                            <div class="col-md-8">
                                <input type="text" name="lastName" id="lastName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">E-mail</label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="group_role">
                            <label class="control-label col-md-4">Position</label>
                            <div class="col-md-8">
                                <select class="form-control" name="position" id="position">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="group_position">
                            <label class="control-label col-md-4">Role</label>
                            <div class="col-md-8">
                                <select class="form-control" name="role" id="role">
                                    <option value="">Select</option>
                                    
                                </select>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
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
            var dt = $('#employees_table').DataTable({
                // Order table
                order: [[ 0, "desc" ]],
                //stateSave: true,

                processing: false,
                serverSide: true,
                ajax: {
                    url: "/admin/employees",
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
                        data: 'firstName',
                        name: 'firstName'
                    },
                    {
                        data: 'lastName',
                        name: 'lastName'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'role',
                        name: 'role'
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
                $("#position").empty();
                $("#role").empty();
                getRoles();
                getPositions();

                //$("#position").find('option:selected').removeAttr("selected");
            });

            $('#data_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

                if($('#action').val() == 'Add')
                {
                    action_url = "/admin/employees";
                }

                if($('#action').val() == 'Edit')
                {
                    // action_url = " route('sample.update') }}";
                    action_url = "/admin/employees/update";
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
                            $('#employees_table').DataTable().ajax.reload();
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
                    url :"/admin/employees/" + id + "/edit",
                    dataType:"json",
                    success:function(data)
                    {
                        $('#firstName').val(data.result.firstName);
                        $('#lastName').val(data.result.lastName);
                        $('#email').val(data.result.email);
                        
                        var roleId = data.result.role_id;
                        var positionId = data.result.position_id;

                        getRoles(roleId);
                        getPositions(positionId);
                        
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

            function getRoles(roleId) 
            {
                //event.preventDefault();
                var roleId = roleId ? roleId : '';

                $("#role").empty();

                $.get("/admin/roles/list", function(data){
                    var rolesList = data;
                    var roleRow = '<option value="">Select</option>';
                    $.each(rolesList, function(i, item){
                        if (roleId == item.id) {
                            roleRow += '<option value="' + item.id + '" selected>';
                        }else{
                            roleRow += '<option value="' + item.id + '">';
                        }
                        roleRow += item.name;
                        roleRow += '</option>';
                    });
                    $('#role').append(roleRow);
                });
            }

            function getPositions(positionId)
            {   
                //event.preventDefault();
                var positionId = positionId ? positionId : '';
                $("#position").empty();

                $.get("/admin/employee-positions/list", function(data){
                    var positionsList = data;
                    var positionsRow = '<option value="">Select</option>';
                    $.each(positionsList, function(i, item){
                        if (positionId == item.id) {
                            positionsRow += '<option value="' + item.id + '" selected>';
                        }else{
                            positionsRow += '<option value="' + item.id + '">';
                        }
                        positionsRow += item.name;
                        positionsRow += '</option>';
                    });
                    $('#position').append(positionsRow);
                });
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
                    url:"/admin/employees/destroy/" + id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            toastr.success('Data has been deleted successfully');
                            $('#confirmModal').modal('hide');
                            $('#ok_button').text('OK');		
                            $('#employees_table').DataTable().ajax.reload();
                            //alert('Data Deleted');
                        }, 2000);
                    }
                })
            });
        });
    </script>
@endsection