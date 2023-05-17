<header>
			<!-- TOP HEADER -->
			
			<div id="top-header" style="background-color: #a942428c !important">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone" style="color:#d12e00f0 !important"></i> +023-45-67-89</a></li>
						<li><a href="#"><i class="fa fa-envelope-o" style="color:#d12e00f0 !important"></i> acakes@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker" style="color:#d12e00f0 !important"></i> Binh Thanh street</a></li>
					</ul>
					<ul class="header-links pull-right">

						@guest
                        <li><a href="{{ route('login') }}"><i class="fa fa-user-o" style="color:#d12e00f0 !important"></i>Login</a></li>
						
						@else
						@if (Auth::check())
						<li style="color:#fff; font-weight:1000" >{{ auth()->user()->name }}</li>
						<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" style="color:#d12e00f0 !important"></i>Logout</a></li>
						@endif
						@endguest
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						

						<!-- SEARCH BAR -->
                        
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{ route('products.search') }}" method="GET">
									<input class="input" name="keyword" placeholder="Search here...">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->
                        <!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="{{ asset('logo/logocakes.png') }}" alt="" style="width:100px">
								</a>
							</div>
						</div>
						<!-- /LOGO -->
						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="qty">{{ $cartItems->count() }}</div>
    </a>
    <div class="cart-dropdown">
            <div class="cart-list">
                @foreach($cartItems as $item)
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a href="#">{{ $item->product->pro_name }}</a></h3>
<h4 class="product-price"><span class="qty">{{ $item->quantity }}x</span>{{ $item->product->price }}</h4>
                        </div>
                        <button class="delete" onclick="removeFromCart({{ $item->id }})"><i class="fa fa-close"></i></button>
                    </div>
                @endforeach
            </div>
            <div class="cart-summary">
                <small>{{ $cartItems->count() }} Item(s) selected</small>
              
            </div>
            <div class="cart-btns">
                <a href="{{route('cart.show')}}">View Cart</a>
                <a>Checkout <i class="fa fa-arrow-circle-right"></i></a>
            </div>
      
    </div>
</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
         <!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="{{ route('getNewProducts') }}">Trang Chủ</a></li>
						@foreach($protypes as $pr)
						<li><a href="products/type/{{$pr->type_id}}">{{$pr -> type_name}}</a></li>
						@endforeach
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

        @yield('content')