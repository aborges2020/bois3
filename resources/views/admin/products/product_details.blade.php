@extends('layouts.adminLte')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product - {{ $data->productName }}</h1>
                    <form method="post" id="active_form">
                        <p>
                            <div class="form-group" id="group_active">
                                <div class="custom-control custom-switch">
                                    @if($data->active == 1)
                                        <input type="checkbox" class="custom-control-input checkboxActive" name="active" id="active" checked>
                                    @else
                                        <input type="checkbox" class="custom-control-input checkboxActive" name="active" id="active">
                                    @endif
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>
                            </div>
                        </p>
                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $data->id }}">
                    </form>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Product / {{ $data->productName }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Engine Optimization for Bots</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="post" id="seo_form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-8">
                                            <label class="control-label">Product Name and SeoTitle (Max size for google search 60 caracteres)</label>
                                            <input type="text" name="productName" id="productName" class="form-control" value="{{ $data->productName }}" maxlength="60">
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-8">
                                            <label class="control-label">Slug</label>
                                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $data->slug }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-12">
                                            <label class="control-label">Seo Description (Max size for google search 120 caracteres)</label>
                                            <textarea name="seoDescription" id="seoDescription" class="form-control" rows="3" maxlength='120'>{{ $data->seoDescription }}</textarea>
                                            <span class="characters text-danger"></span> <span class="text-danger">Remaining</span><br>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $data->id }}">
                                        <button class="btn btn-primary" id="btnSEO">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Google Search Snippet preview</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="googleView">
                                    <p>
                                        <h5>
                                            <small>www.sitedomain.com/category/product...</small><br>
                                            <a href="#">{{ $data->productName }}</a><br>
                                            <small>{{ $data->seoDescription }}</small>
                                        </h5>
                                    </p>
                                </div>
                                <p>
                                    <h5>
                                        <small>www.sitedomain.com/category/product...</small><br>
                                        <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elitaee</a>
                                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean bibendum diam. Mauris tincidunt ante et blandit sodales.</small>
                                    </h5>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="post" id="details_form">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Quantity</label>
                                                <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $data->quantity }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Price</label>
                                                <input type="text" name="price" id="price" class="form-control" value="{{ $data->price }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Category</label>
                                                <input type="text" name="category_id" id="category_id" class="form-control" value="{{ $data->category_id }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Supplier</label>
                                                <input type="text" name="supplier_id" id="supplier_id" class="form-control" value="{{ $data->supplier_id }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Page text (product details)</label>
                                                <textarea type="text" name="description" id="description" class="form-control" rows="20" maxlength="255">{{ $data->description }}</textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $data->id }}">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <p><button class="btn btn-primary" id="btnDetails">Save</button></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Images</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 text-center">
                                        <form method="post" id="upload_form" enctype="multipart/form-data">
                                            @csrf
                                            <p>
                                                @if($data->image == '')
                                                    <span class="uploaded_image">
                                                        <img class="img-fluid" src="/img/default/default-350x250.jpg">
                                                    </span>
                                                @else
                                                    <span class="uploaded_image">
                                                        <img class="img-fluid" src="/img/products/{{ $data->image }}">
                                                    </span>
                                                @endif
                                            </p>
                                            <p>
                                                <div class="form-group">
                                                    <input type="file" class="btn btn-default" name="image" id="image">
                                                    <label for="image"></label>
                                                </div>
                                            </p>
                                            <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $data->id }}">
                                            <p><button class="btn btn-primary" id="btnImage">Upload Image</button></p>
                                        </form>

                                        <p  class="text-right">
                                            {{-- <button class="btn btn-primary" id="btnAddProductImage">Add Image</button> --}}
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#piModal">Add Image</button>
                                        </p>
                                        <!-- Button trigger modal -->

                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th>img</th>
                                                    {{-- <th>widget</th> --}}
                                                    <th>active</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_pi">
                                                @foreach ($data->images as $image)
                                                    <tr id="pi_{{ $image->id }}">
                                                        {{-- <td>{{ $image->id }}</td> --}}
                                                        <td><img class="img-fluid" src="/img/products/{{ $image->imageName }}"></td>
                                                        {{-- <td>{{ $image->widget }}</td> --}}
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="check_{{ $image->id }}" {{ $image->active == 1 ? 'checked':'' }}>
                                                                <label class="custom-control-label" for="check_{{ $image->id }}"></label>
                                                            </div>
                                                        </td>
                                                        <td><button class="btn btn-sm btn-danger deleteImage" value="{{ $image->id }}"><i class="fas fa-trash-alt"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
            <a href="{{ url('/admin/products') }}" class="btn btn-secondary btn-sm"><i class="fas fa-angle-double-left"></i> Back to Products</a>
        </div>
        
        {{-- Modal add image product --}}
        <!-- Modal -->
        <div class="modal fade" id="piModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="upload_form_pi" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <p>
                                <div class="form-group">
                                    <input type="file" class="btn btn-default" name="image_pi" id="image_pi">
                                    <label for="image_pi"></label>
                                </div>
                            </p>
                            <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $data->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection

@section('js_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            
            var currentLength = 120 - $("#seoDescription").val().length;
            $(".characters").text(currentLength);

            $(document).on("input", "#seoDescription", function () {
                var limit = 120;
                
                var charactersTyped = $(this).val().length;
                var charactersRemaining = limit - charactersTyped;               

                $(".characters").text(charactersRemaining);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('#seo_form').on('submit', function(event){
                event.preventDefault();
                
                $.ajax({
                    url: '/admin/products/update-seo',
                    method:"POST",
                    dataType:"JSON",
                    data: $(this).serialize(),
                    //contentType: false,
                    //cache: false,
                    //processData: false,

                    success:function(data)
                    {
                        $('#productName').val(data.productName);
                        $('#seoDescription').val(data.seoDescription);
                        $('#slug').val(data.slug);
                        var htmlRow = '';
                        
                        htmlRow += '<p>'; // id="googleView"
                        htmlRow += '<h5>';   
                        htmlRow += '<small>www.sitedomain.com/category/product...</small><br>';
                        htmlRow += '<a href="#">'+ data.seoTitle + '</a><br>';
                        htmlRow += '<small>' + data.seoDescription + '</small>';
                        htmlRow += '</h5>';
                        htmlRow += '</p>';
                        
                        $('#googleView').html(htmlRow);
                        toastr.success('Data has been updated successfully');
                    }
                });
            });

            $('#details_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"/admin/products/update-details",
                    method:"POST",
                    data: new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if(data.success)
                        {
                            toastr.success(data.success);

                            $('#quantity').val(data.quantity);
                            $('#price').val(data.price);
                            $('#description').val(data.description);
                            $('#category').val(data.category);
                            $('#supplier_id').val(data.supplier_id);
                        }
                    }
                })
            });

            $('#active_form').change('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"/admin/products/update-active",
                    method:"POST",
                    data: new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if(data.success)
                        {
                            toastr.success(data.success);
                            
                            if(data.active == 1)
                            {
                                $('.checkboxActive').prop('checked', true);
                            }else
                            {
                                $('.checkboxActive').prop('checked', false);
                            }
                        }
                    }
                })
            });

            $('#upload_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"/admin/products/upload",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if(data.success)
                        {
                            toastr.success(data.success);
                            $('.uploaded_image').html(data.uploaded_image);
                            $('#upload_form')[0].reset();
                        }
                    }
                })
            });
            
            $('#upload_form_pi').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"/admin/products/upload-pi",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if(data.success)
                        {
                            toastr.success(data.success);
                            
                            htmlRow = '';
                            htmlRow += '<tr id="pi_' + data.productImage.id + '">';
                            htmlRow += '<td><img class="img-fluid" src="/img/products/' + data.productImage.imageName +'"></td>';
                            htmlRow += '<td>';
                            htmlRow += '<div class="custom-control custom-checkbox">';
                            htmlRow += '<input type="checkbox" class="custom-control-input" id="check_' + data.productImage.id + '" checked>';
                            htmlRow += '<label class="custom-control-label" for="check_' + data.productImage.id + '"></label>';
                            htmlRow += '</div>';
                            htmlRow += '</td>';
                            htmlRow += '<td><button class="btn btn-sm btn-danger deleteImage" value="'+ data.productImage.id +'"><i class="fas fa-trash-alt"></i></button></td>';
                            htmlRow += '</tr>';
                            
                            $('#tbody_pi').prepend(htmlRow);
                            $('#upload_form_pi')[0].reset();
                            $('#piModal').modal('hide');                            
                        }
                    }
                })
            });

            $(document).on('click', '.deleteImage', function(){
                var image_id = $(this).val();
                
                $.ajax({
                    url: '/admin/products/delete/' + image_id,
                    type: 'DELETE',
                    beforeSend:function(){
                        //$('#ok_button').text('Deleting..');
                        $("#pi_" + image_id).remove();
                    },
                    success:function(data)
                    {
                        toastr.success(data.success);
                        //$('#confirmModal').modal('hide');
                        //$('#ok_button').text('OK');
                        //$("#ok_button").removeClass('deleteAddress');
                        //$('#address_result').show();
                        // setTimeout(function(){
                        //     $("#address_result").css("display","none");
                        // }, 5000);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                })
            });
        });
    </script>
@endsection
