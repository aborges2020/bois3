{{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

    <h4 class="alert-heading">Ho ho!!!</h4>
    <p>The products below were removed from the shopping cart because they were out of stock.</p>
</div> --}}

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block alert-dismissible fade show" role="alert"">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif
  
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block alert-dismissible fade show" role="alert"">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif
   
@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block alert-dismissible fade show" role="alert"">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Ho ho!!!</h4>
        <p>{{ $message }}</p>
        @if($items_out_of_stock = Session::get('items_out_of_stock'))
            <p>
                @foreach ($items_out_of_stock as $item)
                <strong>{{ $item['product_name'] }}</strong><br>
                @endforeach
            </p>
        @endif
    </div>
@endif
   
@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block alert-dismissible fade show" role="alert"">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif
  
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert"">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Please check the form below for errors
    </div>
@endif

