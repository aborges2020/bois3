<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(isset($seoTitle))
        <title>{{ $seoTitle }} - {{ config('app.name', 'AppName') }}</title>
        <meta description="{{ $seoDescription }}">
    @else
        <title>{{ config('app.name', 'AppName') }}</title>
        <meta description="app description generic">
    @endif
    
    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'AppName') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerApp" aria-controls="navbarTogglerApp" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerApp">
                    <ul class="navbar-nav">
                        {{-- <li class="nav-item {{ Request::is('/' ) ? 'active': ''}}">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('site.home') }}</a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('site.buyHere') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('categories') }}">{{ __('site.allCategories') }}</a>
                                <a class="dropdown-item" href="{{ url('products') }}">{{ __('site.allProducts') }}</a>
                                <div class="dropdown-divider"></div>
                                <div id="categoriesList"></div>
                            </div>
                        </li>
                        <li class="nav-item {{ Request::is('faq' ) ? 'active': ''}}">
                        <a class="nav-link" href="{{ url('faq') }}">{{ __('site.faq') }}</a>
                        </li>
                        <li class="nav-item {{ Request::is('about' ) ? 'active': ''}}">
                            <a class="nav-link" href="{{ url('about') }}">{{ __('site.about') }}</a>
                        </li>
                        <li class="nav-item {{ Request::is('contact' ) ? 'active': ''}}">
                            <a class="nav-link" href="{{ url('contact') }}">{{ __('site.contact') }}</a>
                        </li>
                        {{-- Cart Menu --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i> 
                                <span class="badge badge-warning" id="qty">0</span> | <span id="total">0.00</span> $
                            </a>
                            <div class="dropdown-menu cartMenu" aria-labelledby="navbarDropdown">
                                @if((array)session()->has('cart'))
                                    
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless" id="cartMenu">
                                            @foreach((array) session('cart') as $id => $details)
                                                <tr id="menuProductLine_{{ $id }}">
                                                    <td class="align-middle">
                                                        <button class="btn btn-link removeOne" value="{{ $id }}"><i class="fas fa-minus-circle"></i></button>
                                                        <span class="menuQuantity_{{ $id }}">{{ $details['quantity'] }}</span>  
                                                        <button class="btn btn-link addOne" value="{{ $id }}"><i class="fas fa-plus-circle"></i></button>
                                                    </td>
                                                    <td class="align-middle">{{ $details['productName'] }}</td>
                                                    <td class="align-middle">{{ $details['price'] }}</td>
                                                    <td class="align-middle">
                                                        <button class="btn btn-sm btn-link text-danger removeProduct" value="{{ $id }}"><i class="fas fa-times-circle"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                @endif
                                <ul class="list-group">
                                    <li class="text-center text-info" id="emptyCart">{{ __('site.cartEmpty') }}</li>
                                    <li class="text-center" id="btnMyCart"><a class="btn btn-sm btn-secondary" href="{{ url('cart') }}">{{ __('site.myCart') }}</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        @guest
                            <li class="nav-item {{ Request::is('login' ) ? 'active': ''}}">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('site.login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ Request::is('my-account' ) ? 'active': ''}}" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Hi {{ Auth::user()->firstName }} <span class="caret"></span></a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('my.account') }}">{{ __('site.myAccount') }}</a>
                                    <a class="dropdown-item" href="{{ route('my.profile') }}">{{ __('site.myProfile') }}</a>
                                    <a class="dropdown-item" href="{{ route('my.orders') }}">{{ __('site.myOrders') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('site.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">#</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid margin-top-minus-20">
            <div class="container text-right">
                <a href="{{ url('locale/en') }}" title="Change language to English">en |</a>
                {{-- <a href="{{ url('locale/es') }}" title="Cambiar idioma a español">es | </a> --}}
                <a href="{{ url('locale/fr') }}" title="Changer la langue en Français ">fr | </a>
                <a href="{{ url('locale/pt') }}" title="Mudar idioma para português">pt</a>
            </div>
        </div>
        <main class="container">
            &nbsp;
            @include('site.flashMessages.flash_message')
            
            @yield('content')
        </main>

        <footer class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <hr>
                    <h3>Footer</h3>
                <p> 
                    {{ __('site.socialNetwork') }}<br> 
                    <a href="{{-- isset($configs->facebook) --}}">Facebook</a>  | 
                    <a href="{{ isset($configs->instagram) }}">Instagram</a>
                    <hr>
                    {{ __('site.telephone') }} {{ isset($configs->telephone) }} |
                    {{ __('site.address') }}: {{ isset($configs->address) }}
                </p>
                </div>
            </div>
        </footer>
    </div>
    {{-- JS Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- JS Customization Scripts --}}
    <script src="{{ asset('js/site/custom.js') }}"></script>
    @yield('js_scripts')
</body>
</html>