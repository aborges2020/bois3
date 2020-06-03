@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>My Cart</h2>
            
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th class="align-middle">Products</th>
                            <th class="text-center align-middle">Qty</th>
                            <th class="text-right align-middle">Price</th>
                            <th class="text-right align-middle">Subtotal</th>
                            <th class="text-center align-middle">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach((array) session('cart') as $id => $details)
                            <tr id="cartProductLine_{{ $id}}">
                                <td class="align-middle"><img class="img-fluid" src="img/products/{{ $details['image'] }}"/ width="50"> {{ $details['productName'] }}</td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-link removeOne" value="{{ $id }}"><i class="fas fa-minus-circle"></i></button> 
                                    <span class="quantity_{{ $id }}">{{ $details['quantity'] }}</span>
                                    <button class="btn btn-link addOne" value="{{ $id }}"><i class="fas fa-plus-circle"></i></button>
                                </td>
                                <td class="text-right align-middle"><span class="price_{{ $id }}">{{ $details['price'] }}</span> $</td>
                                <td class="text-right align-middle"><span class="subtotal_{{ $id }}"> {{ number_format($details['quantity'] * $details['price'], 2) }}</span> $</td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-link removeProduct text-danger" value="{{ $id }}" title="Remove product">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        <?php $total = 0; $qty = 0; ?>
                        @foreach((array) session('cart') as $id => $details)
                            <?php $total += $details['price'] * $details['quantity']; $qty +=$details['quantity'] ?>
                        @endforeach

                        <tr>
                            <td class="text-right align-middle">Total Items:</td>
                            <td class="text-center align-middle"><span id="totalQty"> {{ $qty }} </span>{{-- count((array) session('cart')) --}}</td>
                            <td class="text-right align-middle">Total :</td>
                            <td class="text-right align-middle"><span id="totalCart"> {{ number_format($total, 2) }}</span> $</td>
                            <td class="text-center align-middle"><button class="btn btn-link text-danger" id="clearCart" title="Clear cart"><i class="fas fa-trash-alt"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Discount coupom</h3>
            <hr>
            <form action="POST" id="form_coupom">
                <div class="row">
                    <div class="col-4 input-group mb-3">
                        <input type="text" class="form-control" name="coupom_code" id="coupom_code" value="" maxlength="25" placeholder="xxxxxxxxxx" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append" id="btn_coupom_ok">
                            <button class="btn btn-secondary" type="submit" name="btn_coupom_code" id="btn_coupom_code">Ok</button>
                        </div>
                    </div>
                </div>
            </form>
            <p id="coupom_data"></p>
        </div>
    </div>
    @guest

    @else
        <div class="row">
            <div class="col-12">
                <h3>Shippings options</h3>
                <hr>
                @if (count($shippings) > 0)
                    <div class="card-deck">
                        @foreach ($shippings as $row)
                            <div class="card">
                                <h5 class="card-header">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="shipping_{{ $row->id }}" name="shipping" value="{{ $row->id }}" data-cost="{{ $row->cost }}" class="custom-control-input" required>
                                        <label class="custom-control-label" for="shipping_{{ $row->id }}">{{ $row->name }}</label>
                                    </div>
                                </h5>
                                <div class="card-body">
                                <p class="card-text">{{ $row->description }}</p>
                                <p class="card-text">Cost: {{ $row->cost }} $</p>
                                </div>
                            </div>
                        @endforeach        
                    </div>
                @else
                    <p>No data avalaible!</p>
                @endif
                <div class="invalid-feedback" id="invalid-shipping">
                    Please check a delivery option!
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                &nbsp;
                <h3>Payments options</h3>
                <hr>
                @if (count($payments) > 0)
                    <div class="card-deck">
                        @foreach ($payments as $row)
                            <div class="card">
                                <h5 class="card-header">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="payment_{{ $row->id }}" name="payment" value="{{ $row->id }}" class="custom-control-input" required>
                                        <label class="custom-control-label" for="payment_{{ $row->id }}">{{ $row->name }}</label>
                                    </div>
                                </h5>
                                <div class="card-body">
                                <p class="card-text">{{ $row->description }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="hide" id="installment" data-installment="1"></div>        
                    </div>
                @else
                    <p>No data avalaible!</p>
                @endif
                <div class="invalid-feedback" id="invalid-payment">
                    Please check a payment option!
                </div>  
            </div>
        </div>
    @endguest
    
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <div class="">
                    <hr>
                    <button class="btn btn-secondary">Continue Shopping</button> 
                    
                    {{-- Se nao tem usuario logado exibe --}}
                    {{-- btn pra chamar um modal pra fazer o login ou fazer o cadastro --}}
                    {{-- ou ver uma forma de finalizar sem ter o cadastro e cadastrar ao mesmo tempo --}}
                    {{-- ou tipo fazer login social pra cadastrar e botar o cara pra preencher os dados de endereço e telefone em seguida --}}
                    {{-- Se o pagamento for com cartão é obrigado a ter cadastro completo endereço e telefone ( se for brasil ainda tem de ter cpf e rg )--}}
                    
                    
                    {{-- Se tem usuario logado exibe --}}
                    @guest
                        <button type="button" class="btn btn-primary" id="login" data-toggle="modal" data-target="#exampleModal">
                            Proceed to checkout
                        </button>
                    @else 
                        <button class="btn btn-success" id="checkout">Proceed to checkout</button>
                        <form action="{{ url('/checkout') }}" method="POST" id="form_checkout">
                            @csrf
                            <input type="hidden" name="form_coupom_code" id="form_coupom_code">
                            <input type="hidden" name="form_coupom_type" id="form_coupom_type">
                            <input type="hidden" name="form_coupom_value" id="form_coupom_value">
                            <input type="hidden" name="form_shipping_method" id="form_shipping_method">
                            <input type="hidden" name="form_shipping_cost" id="form_shipping_cost">
                            <input type="hidden" name="form_payment_method" id="form_payment_method">
                            <input type="hidden" name="form_installment" id="form_installment">
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    
                </div> --}}
                
                <div class="modal-body">
                    <p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </p>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <h5>Already have an account?</h5>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
        
                                
                                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                                    
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
        
                                    
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
        
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    
                                
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class=" text-center">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <h5>New Customer? Create account...</h5>
                                <p><a href="{{ url('register') }}" class="btn btn-primary">Make a new register</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
