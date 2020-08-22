@php $current_route = Route::currentRouteName(); @endphp
<div class="header-content fixed-top bg-white">
	<nav class="navbar navbar-expand-lg">
		<div class="container align-items-stretch px-0">
			<div class="navbar-logo text-left col-5 col-md-auto col-sm-auto">
			<a class="navbar-brand text-center" href="/" title="Yachaywasinet">
				Yachaywasinet
			</a>
			</div>
			<button class="navbar-toggler align-middle navbar-toggler-right collapsed border-0" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse px-0" id="navbarResponsive">
				<div class="navbar-content navbar-collapse py-3 py-md-0">
				<ul class="navbar-nav align-items-center text-center ml-auto">
					<li class="nav-item col-12 col-md-7 col-lg-auto"><a class="nav-link{{ $current_route == 'nosotros' ? ' active' : '' }}" href="{{route('nosotros')}}">Nosotros</a>
					</li>
					@if (Route::has('login'))
	                    @auth
	                    <li class="nav-item col-12 col-md-7 col-lg-auto"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
	                    <li class="nav-item col-12 col-md-7 col-lg-auto"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
	                    @else
	                    <li class="nav-item col-12 col-md-7 col-lg-auto"><a class="nav-link" href="/cursos">Cursos</a></li>
	                    <li class="nav-item col-12 col-md-7 col-lg-auto"><a class="nav-link" href="/temas">Temas</a></li>
	                    @endauth
	            	@endif
				</ul>
				</div>
			</div>
		</div>
	</nav>
</div>