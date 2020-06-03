@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <div class="col-sm-12 col-md-2 text-center" id="thumb">
                    @foreach ($product->images as $image)
                        @if($loop->iteration > 5)
                            @break
                        @endif
                        <a href="#">
                            <img src="/img/products/{{ $image->imageName }}" class="rounded img-fluid margin-bottom-10 thumb_product" alt="#" width="150px" data-id="{{ $loop->iteration }}">
                        </a>
                    @endforeach
                </div>
                <div class="col-sm-12 col-md-7" id="frame">
                    @foreach ($product->images as $image)
                        @if($loop->iteration > 5)
                            @break
                        @endif
                        <img src="/img/products/{{ $image->imageName }}" class="img-fluid {{ $loop->first ?  '':'d-none' }} frame_product" alt="image {{ $image->imageName }}" data-id="{{ $loop->iteration }}">
                    @endforeach
                </div>
                <div class="col-sm-12 col-md-3">
                    <h2 id="productName">{{ $product->productName }}</h2>
                    <hr>
                    <p><span id="productPrice"><h3>{{ $product->price }} $</h3></span></p>
            
                    @if($product->quantity > 0)
                        <p><span id="productButton"><button data-product="{{ $product->id }}" value="{{ $product->id }}"class="addButton btn btn-success btn-block"> Add to Cart</button></span></p>
                        <p><span id="productButton"><a href="{{ url('cart') }}" class="btn btn-secondary btn-block"> View Cart</a></span></p>
                    @else
                        <p><span id="productButton"><button data-product="{{ $product->id }}" value="{{ $product->id }}"class="wishButton btn btn-warning">Wish List</button></span></p>
                    @endif
                </div>
            </div>
            {{-- <hr>    
            <div class="row">
                <div class="col-sm-10 col-md-10">
                    @if(count($product->images) > 0)
                        <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for ($i = 0; $i < count($product->images); $i++)
                                    <li data-target="#carouselIndicators" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active':'' }}"></li>
                                @endfor
                            </ol>
                            <div class="carousel-inner" height="521" style="max-height:521px;">
                                @foreach ($product->images as $image)
                                    <div class="carousel-item {{ $loop->first ?  'active':'' }}">
                                        <img src="/img/products/{{ $image->imageName }}" class="d-block w-100 img-fluid" alt="#">
                                    </div>
                                @endforeach
                            </div>
                            
                            <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @else
                        <span id="productImage"><img class="img-fluid" src="/img/products/{{ $product->image }}" alt=""></span>
                    @endif
                </div>
            </div> --}}
            
            {{-- <p><span id="productPrice"><h3>Price {{ $product->price }} $</h3></span></p>
            
            @if($product->quantity > 0)
                <p><span id="productButton"><button data-product="{{ $product->id }}" value="{{ $product->id }}"class="addButton btn btn-success"> Add to Cart</button></span></p>
            @else
                <p><span id="productButton"><button data-product="{{ $product->id }}" value="{{ $product->id }}"class="wishButton btn btn-warning">Wish List</button></span></p>
            @endif --}}
            <div class="card">
                <div class="card-body text-white bg-secondary">
                    <p><span id="productDescription">{{ $product->description }}</span></p>
                </div>
            </div>
            
        </div>
    </div>   
</div>
@endsection

