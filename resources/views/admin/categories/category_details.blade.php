@extends('layouts.adminLte')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category - {{ $data->categoryName }}</h1>
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
                        <li class="breadcrumb-item active">Categories / {{ $data->categoryName }}</li>
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
                                            <label class="control-label">Category Name and SeoTitle (Max size for google search 60 caracteres)</label>
                                            <input type="text" name="categoryName" id="categoryName" class="form-control" value="{{ $data->categoryName }}" maxlength="60">
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
                                            <small>www.sitedomain.com/category...</small><br>
                                            <a href="#">{{ $data->categoryName }}</a><br>
                                            <small>{{ $data->seoDescription }}</small>
                                        </h5>
                                    </p>
                                </div>
                                <p>
                                    <h5>
                                        <small>www.sitedomain.com/category...</small><br>
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
                                                <label class="control-label">Subcategory</label>
                                                <input type="text" name="subCategory" id="subCategory" class="form-control" value="{{ $data->subCategory }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6"></div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Page text (category details)</label>
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
                                <h3 class="card-title">Image</h3>
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
                                                        <img class="img-fluid" src="/img/categories/{{ $data->image }}">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
            <a href="{{ url('/admin/categories') }}" class="btn btn-secondary btn-sm"><i class="fas fa-angle-double-left"></i> Back to Categories</a>
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
                    url: '/admin/categories/update-seo',
                    method:"POST",
                    dataType:"JSON",
                    data: $(this).serialize(),
                    //contentType: false,
                    //cache: false,
                    //processData: false,

                    success:function(data)
                    {
                        $('#categoryName').val(data.categoryName);
                        $('#seoDescription').val(data.seoDescription);
                        $('#slug').val(data.slug);

                        var htmlRow = '';
                        
                        htmlRow += '<p>'; // id="googleView"
                        htmlRow += '<h5>';   
                        htmlRow += '<small>www.sitedomain.com/category...</small><br>';
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
                    url:"/admin/categories/update-details",
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

                            
                            $('#description').val(data.result.description);
                            $('#subCategory').val(data.result.subCategory);
                        }
                    }
                })
            });

            $('#upload_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"/admin/categories/upload",
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

            $('#active_form').change('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"/admin/categories/update-active",
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
        });
    </script>
@endsection
