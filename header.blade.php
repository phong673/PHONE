<header>
    <div class="header-container">
        <div class="container">
            <div class="row">
                        
                <!-- Header Top Links -->
                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 pull-right hidden-xs">
                    <div class="toplinks">
                        <div class="links">
                                    
                            <!-- Header Company -->
                            @if (Auth::user())
                            <div class="dropdown block-company-wrapper hidden-xs">
                                <a role="button" data-toggle="dropdown" data-target="#" class="block-company dropdown-toggle" href="#"> Danh Sách
                                     <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!--<li role="presentation"><a href=""> About Us </a></li>
                                    <li role="presentation"><a href="{{ route('wishlist.create') }}"> Compare </a></li>-->
                                    
                                        <li role="presentation"><a href="{{ route('wishlist.index') }}"> Danh sách yêu thích </a></li>
                                        <li role="presentation"><a href="{{ route('wishlist.create') }}"> So sánh sản phẩm </a></li>
                                        <li role="presentation"><a href="{{ route('history.index') }}"> Lịch sử đặt hàng </a></li>
                                    
                                </ul>
                            </div>
                            @endif
                            <!-- End Header Company -->
                            <div class="login">
                                @if (!Auth::user())
                                    <a href="{{ route('login.index') }}">
                                        <span class="hidden-xs">Đăng Nhập</span>
                                    </a>
                                @else
                                    <a href="{{ route('logout.index') }}">
                                        <span class="hidden-xs">Đăng Xuất</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Header Top Links -->
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 logo-block">
                <!-- Header Logo -->
                    <div class="logo">
                        <a title="Linea HTML Template" href="{{ route('home') }}">
                            <img style="width:50%; margin-top:-18px;"alt="Linea HTML" src="{{ asset('frontend/images/logo.png') }}">
                        </a>
                    </div>
                <!-- End Header Logo -->
            </div>
            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-3 hidden-xs category-search-form">
                <div class="search-box">
                    <form id="search_mini_form" action="{{ route('home.create') }}" method="get">
                        <!-- Autocomplete End code -->
                        <input id="search" type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="" class="searchbox" maxlength="128">
                        <button type="submit" title="Search" class="search-btn-bg" id="submit-button"></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 card_wishlist_area">
                <div class="mm-toggle-wrap">
                    <div class="mm-toggle">
                        <i class="fa fa-align-justify"></i>
                        <span class="mm-label">Menu</span> </div>
                    </div>
                    <div class="top-cart-contain" id="top-cart-contain">
                        <!-- Top Cart -->
                        <div class="mini-cart">
                            <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
                                <a href="{{ route('cart.index') }}">
                                    <span class="price hidden-xs">Giỏ Hàng</span>
                                    
                                </a>
                            </div>
                            <div>
                                <div class="top-cart-content" id="top-cart-content">
                                    <!--block-subtitle-->
                                    <ul class="mini-products-list" id="cart-sidebar"></ul>
                                    <!--actions-->
                                    <div class="actions">
                                        <button class="btn-checkout" title="Checkout" type="button">
                                            @if (Auth::user())
                                                <a style="color: #fff;"href="{{ route('cart-address.index') }}"><span>Đặt Hàng</span></a>
                                            @else
                                                <a style="color: #fff;"href="{{ route('login.index') }}"><span>Đặt Hàng</span></a>
                                            @endif
                                        </button>
                                        <a href="{{ route('cart.index') }}" class="view-cart">
                                            <span>Giỏ Hàng</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Top Cart -->

                    </div>
                    <!-- mgk wishlist -->
                </div>
            </div>
        </div>
        <nav class="hidden-xs">
            <div class="nav-container">
                <div class="col-md-3 col-xs-12 col-sm-4">
                    <div class="mega-container visible-lg visible-md visible-sm">
                        <div class="navleft-container">
                            <div class="mega-menu-title" id="mega-menu-title">
                                <h3><i class="fa fa-navicon"></i> Danh Mục</h3>
                            </div>
                            <div class="mega-menu-category" id="mega-menu-category" style="{{ $url_canonical == route('home') || $url_canonical == route('cart-address.index') ? '' : 'display: none' }}">
                                <ul class="nav">
                                    <li class="nosub"><a href="{{ route('home') }}"><i class="fa fa-home"></i> Trang Chủ</a> </li>
                                    <li><a><i class="fa fa-file-text"></i> Sản Phẩm</a></li>
                                    @foreach ($all_category as $all_cate)
                                        <li>
                                            <a href="{{ route('category-product.show', $all_cate->category_slug) }}">
                                                {{ $all_cate->category_name }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    
            </div>
        </nav>
        </header>