@extends('layouts.site')

@section('content')
<div class="row">
    <div class="col-md-10">
        <h4>My Profile</h4>
        <hr>
        <form method="POST" id="profileForm" name="profileForm">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstName">First name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastName">Last name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control" id="email" name="email" value="" required>
                    </div>
                </div>
            </div>
            <span class="text-success" id="profile_result"></span>
            <button type="submit" class="btn btn-primary" id="btn-save-profile" value="{{ Auth::user()->id }}">Save changes</button>
        </form>
    </div>
    <div class="col-md-2 bg-secondary text-center">
        <br><br><br>
        <p><img src="" id="image" class="img-thumbnail" ></p>
        <p><button class="btn btn-primary">Upload Image</button></p>
    </div>
    
    <div class="clearfix"></div>
        
    <div class="col-md-12">
        <br>
        <h4>Password</h4>
        <hr>
        <form method="PUT" id="passwordForm" name="passwordForm">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">New password:</label>
                        <input type="text" class="form-control" id="password" name="password" value="" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password2">Confirm password:</label>
                        <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" value="" required>
                    </div>
                </div>
            </div>
            <span id="password_result"></span>
            <button type="submit" class="btn btn-primary" id="btn-save-password" value="{{ Auth::user()->id }}">Save changes</button>
        </form>
        <br><br>
    </div>

    <div class="col-md-12">
        <h4 class="float-left">My Adresses</h4>
        {{-- <a href="javascript:void(0)" class="btn btn-sm btn-success float-right" id="create-address">Add Address</a> --}}
        <button type="button" class="btn btn-sm btn-warning float-right" id="create-address">Add Address</button>

        <div class="clearfix"></div>
        <span class="text-success" id="address_result"><p>Address updated/added successfully</p></span>

        <table class="table table-sm table-striped" id="table_address">
            <thead>
                <tr>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Primary</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody id="tbody_adresses"></tbody>
        </table>
    </div>
    <div class="col-md-12">
        <h4 class="float-left">My Telephones</h4>
        {{-- <button type="button" class="btn btn-sm btn-warning float-right" id="create-telephone">Add Telephone</button> --}}

        <div id="buttonAddTel" value="{{ Auth::user()->telephones->count() }}">
            @if (Auth::user()->telephones->count() >= 3)

            @else
                <button type="button" class="btn btn-sm btn-warning float-right" id="create-telephone">AddTelephone</button>
            @endif
        </div>
        <div class="clearfix"></div>
        <span class="text-success" id="telephone_result"><p>Telephone updated/added successfully</p></span>
        
        <table class="table table-sm table-striped" id="telephones_table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Primary</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody id="tbody_telephones"></tbody>
        </table>
    </div>
</div>

{{-- Modal Address --}}
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="POST" id="addressForm" name="addressForm">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="address_id" id="address_id">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="number">Number:</label>
                        <input type="text" class="form-control" id="number" name="number" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" id="state" name="state" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" id="country" name="country" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="primaryAddress">Primary Address:</label>
                        <input type="checkbox" class="checkboxAddress" id="primaryAddress" name="primaryAddress">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-address" value="">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Telephone --}}
<div class="modal fade" id="telephoneModal" tabindex="-1" role="dialog" aria-labelledby="telephoneModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form id="telephoneForm" name="telephoneForm">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="telephoneModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="telephone_id" id="telephone_id">
                    <div class="form-group">
                        <label for="telNumber">Number:</label>
                        <input type="text" class="form-control" id="telNumber" name="telNumber" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="primaryTelephone">Primary Telephone:</label>
                        <input type="checkbox" class="checkboxTelephone" id="primaryTelephone" name="primaryTelephone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-telephone" value="">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
<script>
    $(document).ready(function () 
    {
        
        
        $('#profile_result').hide();
        $('#password_result').hide();
        $('#address_result').hide();
        $('#telephone_result').hide();

        // Profile
        $.get('/my-account/profile', function (data) 
        {
            $('#firstName').val(data.firstName);
            $('#lastName').val(data.lastName);
            $('#email').val(data.email);
            $('#image').attr('src', data.image);
        })

        $('#profileForm').on('submit', function(event)
        {
            event.preventDefault();
            
            $('#btn-save-profile').html('Sending..');
            var action_url = '/my-account/profile/';
            var action_type = "PUT";
            $.ajax({
                url: action_url,
                method: action_type,
                data: $(this).serialize(),
                dataType: "json",
                success:function(data)
                {
                    $('#profile_result').show();
                    $("#profile_result").html(data.msg);
                    setTimeout(function(){
                        $("#profile_result").css("display","none");
                    }, 5000);  
                    $('#firstName').val(data.client.firstName);
                    $('#lastName').val(data.client.lastName);
                    $('#email').val(data.client.email);
                    $('#btn-save-profile').html('Save Changes');
                },
                error: function (data) 
                {
                    console.log('Error:', data);
                    $('#btn-save-profile').html('Save Changes');
                }
            });
        });
        // Profile

        // Password
        $('#passwordForm').on('submit', function(event)
        {
            event.preventDefault();
            
            $('#btn-save-password').html('Sending..');
            var client_id = $('#btn-save-password').val();
            var action_url = '/my-account/password/';
            var action_type = "PUT";
            
            $.ajax({
                url: action_url,
                method: action_type,
                data: $(this).serialize(),
                dataType: "json",
                success:function(data)
                {
                    $('#password_result').show();
                    $("#password_result").html(data.msg);
                    $('#btn-save-password').html('Save Changes');
                    $('#passwordForm').trigger("reset");
                },
                error: function (data) 
                {
                    console.log('Error:', data);
                    $('#btn-save-password').html('Save Changes');
                }
            });
        });
        // Password

        // Address
        // Adresses table
        $.get('/my-account/address/', function (data) 
        {
            var listAdresses = data;
            var addressRow = '';
            $.each(listAdresses, function (i, item) {
                addressRow += '<tr id="address_id_' + item.id + '">';
                addressRow += '<td>' + item.address + ', ' + item.number + '</td>';
                addressRow += '<td>' + item.city + '</td>';
                addressRow += '<td>' + item.state + '</td>';
                addressRow += '<td>' + item.country + '</td>';
                addressRow += '<td>' + item.primaryAddress + '</td>';
                addressRow += '<td><div class="btn-group" role="group" aria-label="address-group">';
                addressRow += '<button type="button" id="edit-address" data-id="' + item.id + '"class="btn btn-sm btn-primary btn-group-sm edit-address">Edit</button>';
                addressRow += '<button type="button" id="delete-address" data-id="' + item.id + '"class="btn btn-sm btn-danger btn-group-sm delete-address">Delete</button>';
                addressRow += '</div></td>';
                addressRow += '</tr>';
            });    
            $('#tbody_adresses').append(addressRow);
        })
        /* When user click add address button */
        $('#create-address').click(function () 
        {
            $('#btn-save-address').val("create-address");
            $('#addressForm').trigger("reset");
            $('#addressModalLabel').html("Add New Address");
            $('#addressModal').modal('show');
        });

        /* When click edit address */
        $(document).on('click', '.edit-address', function() 
        {    
            var address_id = $(this).data('id');
            $.get('/my-account/address/' + address_id, function (data) 
            {
                $('#addressModalLabel').html("Edit Telephone");
                $('#btn-save-address').val("edit-address");
                $('#addressModal').modal('show');
                $('#address_id').val(data.id);
                $('#address').val(data.address);
                $('#number').val(data.number);
                $('#city').val(data.city);
                $('#state').val(data.state);
                $('#country').val(data.country);
                if(data.primaryAddress == 1)
                {
                    $('.checkboxAddresse').prop('checked', true);
                }else
                {
                    $('.checkboxAddresse').prop('checked', false);
                }
            })
        });
        // Address submit for create or edit
        $('#addressForm').on('submit', function(event)
        {
            event.preventDefault();
            var actionType = $('#btn-save-address').val();
            var address_id = $('#address_id').val();
            var action_url = '/my-account/address';
            var action_type = 'POST';
            if(actionType == 'edit-address')
            {
                action_url += "/" + address_id;
                action_type = "PUT";
            }
            $('#btn-save-address').html('Sending..');
            $.ajax({
                url: action_url,
                method: action_type,
                data: $(this).serialize(),
                dataType: "json",
                success:function(data)
                {
                    var addressRow = '<tr id="address_id_' + data.id + '">';
                        addressRow += '<td>' + data.address + ', ' + data.number + '</td>';
                        addressRow += '<td>' + data.city + '</td>';
                        addressRow += '<td>' + data.state + '</td>';
                        addressRow += '<td>' + data.country + '</td>';
                        addressRow += '<td>' + data.primaryAddress + '</td>';
                        addressRow += '<td><div class="btn-group" role="group" aria-label="address-group">';
                        addressRow += '<button type="button" id="edit-address" data-id="' + data.id + '"class="btn btn-sm btn-primary edit-address">Edit</button>';
                        addressRow += '<button type="button" id="delete-address" data-id="' + data.id + '"class="btn btn-sm btn-danger delete-address">Delete</button>';
                        addressRow += '</div></td>';
                        addressRow += '</tr>';
                    
                    if (actionType == "create-address") 
                    {
                        $('#tbody_adresses').prepend(addressRow);
                    } else 
                    {
                        $("#address_id_" + data.id).replaceWith(addressRow);
                    }
                    $('#addressForm').trigger("reset");
                    $('#addressModal').modal('hide');
                    $('#btn-save-address').html('Save Changes');
                    $('#address_result').show();
                    setTimeout(function(){
                        $("#address_result").css("display","none");
                    }, 5000);
                },
                error: function (data) 
                {
                    console.log('Error:', data);
                    $('#btn-save-address').html('Save Changes');
                }
            });
        });

        // Delete address
        $(document).on('click', '.delete-address', function(){
            $('.modal-title').text('Confirmation');
            $('#confirmModal').modal('show');
            var address_id = $(this).data("id");
            $("#ok_button").val(address_id);
            $("#ok_button").toggleClass('deleteAddress');
        });

        $(document).on('click', '.deleteAddress', function(){
            var address_id = $('#ok_button').val();
            $.ajax({
                url: '/my-account/address/' + address_id,
                type: 'DELETE',
                beforeSend:function(){
                    $('#ok_button').text('Deleting..');
                    $("#address_id_" + address_id).remove();
                },
                success:function(data)
                {
                    $('#confirmModal').modal('hide');
                    $('#ok_button').text('OK');
                    $("#ok_button").removeClass('deleteAddress');
                    $('#address_result').show();
                    setTimeout(function(){
                        $("#address_result").css("display","none");
                    }, 5000);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });
        // Address

        // Adresses table
        $.get('/my-account/telephone/', function (data) 
        {
            var listTelephone = data;
            var telephoneRow = '';
            $.each(listTelephone, function (i, item) {
                telephoneRow += '<tr id="telephone_id_' + item.id + '">';
                telephoneRow += '<td>' + item.number + '</td>';
                telephoneRow += '<td>' + item.primaryTelephone + '</td>';
                telephoneRow += '<td><div class="btn-group" role="group" aria-label="address-group">';
                telephoneRow += '<button type="button" id="edit-telephone" data-id="' + item.id + '"class="btn btn-sm btn-primary btn-group-sm edit-telephone">Edit</button>';
                telephoneRow += '<button type="button" id="delete-telephone" data-id="' + item.id + '"class="btn btn-sm btn-danger btn-group-sm delete-telephone">Delete</button>';
                telephoneRow += '</div></td>';
                telephoneRow += '</tr>';
            });    
            $('#tbody_telephones').append(telephoneRow);
        })

        // Delete telephone
        $(document).on('click', '.delete-telephone', function(){
            $('.modal-title').text('Confirmation');
            $('#confirmModal').modal('show');
            var telephone_id = $(this).data("id");
            $("#ok_button").val(telephone_id);
            $("#ok_button").toggleClass('deleteTelephone');
        });

        $(document).on('click', '.deleteTelephone', function(){
            var telephone_id = $('#ok_button').val();
            $.ajax({
                url: '/my-account/telephone/' + telephone_id,
                type: 'DELETE',
                beforeSend:function(){
                    $('#ok_button').text('Deleting..');
                    $("#telephone_id_" + telephone_id).remove();
                },
                success:function(data)
                {
                    $('#confirmModal').modal('hide');
                    $('#ok_button').text('OK');
                    $("#ok_button").removeClass('deleteTelephone');
                    $('#telephone_result').show();
                    setTimeout(function(){
                        $("#telephone_result").css("display","none");
                    }, 5000);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });       

        /* When user click add telephone button */
        $('#create-telephone').click(function () 
        {
            $('#btn-save-telephone').val("create-telephone");
            $('#telephoneForm').trigger("reset");
            $('#telephoneModalLabel').html("Add New Telephone");
            $('#telephoneModal').modal('show');
        });
        
        /* When click edit telephone */
        $(document).on('click', '.edit-telephone', function() 
        {    
            var telephone_id = $(this).data('id');
            $.get('/my-account/telephone/' + telephone_id, function (data) 
            {
                $('#telephoneModalLabel').html("Edit Telephone");
                $('#btn-save-telephone').val("edit-telephone");
                $('#telephoneModal').modal('show');
                $('#telephone_id').val(data.id);
                $('#telNumber').val(data.number);
                if(data.primaryTelephone == 1)
                {
                    $('.checkboxTelephone').prop('checked', true);
                }else
                {
                    $('.checkboxTelephone').prop('checked', false);
                }
            })
        });
        // Telephone submit for create or edit
        $('#telephoneForm').on('submit', function(event)
        {
            event.preventDefault();
            var actionType = $('#btn-save-telephone').val();
            var telephone_id = $('#telephone_id').val();
            var action_url = '/my-account/telephone';
            var action_type = 'POST';
            if(actionType == 'edit-telephone')
            {
                action_url += "/" + telephone_id;
                action_type = "PUT";
            }
            $('#btn-save-telephone').html('Sending..');
            $.ajax({
                url: action_url,
                method: action_type,
                data: $(this).serialize(),
                dataType: "json",
                success:function(data)
                {
                    var telephone = '<tr id="telephone_id_' + data.id + '">';
                        telephone += '<td>' + data.number + '</td>';
                        telephone += '<td>' + data.primaryTelephone + '</td>';
                        telephone += '<td><div class="btn-group" role="group" aria-label="telephone-group">';
                        telephone += '<button type="button" id="edit-telephone" data-id="' + data.id + '"class="btn btn-sm btn-primary edit-telephone">Edit</button>';
                        telephone += '<button type="button" id="delete-telephone" data-id="' + data.id + '"class="btn btn-sm btn-danger delete-telephone">Delete</button>';
                        telephone += '</div></td>';
                        telephone += '</tr>';
                    
                    if (actionType == "create-telephone") 
                    {
                        $('#tbody_telephones').prepend(telephone);
                    } else 
                    {
                        $("#telephone_id_" + data.id).replaceWith(telephone);
                    }
                    
                    $('#telephoneForm').trigger("reset");
                    $('#telephoneModal').modal('hide');
                    $('#btn-save-telephone').html('Save Changes');
                    $('#telephone_result').show();
                    setTimeout(function(){
                        $("#telephone_result").css("display","none");
                    }, 5000);
                },
                error: function (data) 
                {
                    console.log('Error:', data);
                    $('#btn-save-telephone').html('Save Changes');
                }
            });
        });
    }); 
</script>
@endsection