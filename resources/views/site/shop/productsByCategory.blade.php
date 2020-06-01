@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="col">
        <h2>Products in {{ $category->categoryName }}</h2>
            <hr>
        </div>
    </div>
    
    <div class="row" id="productsbyCategory">
        @foreach ($products as $row)
            <div class="col-sm-6 col-md-4 col-lg-3 margin-top-25">
                <div class="card h-100">
                    @if($row->image == '')
                        <img src="img/site/default-250x150.jpg" class="card-img-top">
                    @else
                        <img src="img/products/{{ $row->image }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $row->productName }}</h5>
                        <p class="card-text"> {{ $row->price }} $</p>
                        <p class="card-text"> {{ $row->description }}</p>
                        @if($row->quantity > 0)
                            <button data-product="{{ $row->id }}" value="{{ $row->id }}" class="addButton btn btn-success"><i class="fas fa-cart-plus"></i> Add</button>
                        @else
                            <button data-product="{{ $row->id }}" value="{{ $row->id }}" class="wishButton btn btn-warning">Wish List</button>
                        @endif
                        <a href="/{{ $row->category->slug }}/{{ $row->slug }}" class="btn btn-link margin-right-5">Description</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
