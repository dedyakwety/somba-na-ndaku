<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>SOMBA NA NDAKU</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Colo Shop Template">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="{{ asset('styles/header.css') }}">
		
		<!--  TOUTES LES PAGES -->
		<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap4/bootstrap.min.css') }}">
		<link href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/animate.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
		@if(Route::is('Articles.show') OR Route::is('Panier.index') OR Route::is('Panier.edit'))
			<link rel="stylesheet" href="{{ asset('plugins/themify-icons/themify-icons.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('styles/single_styles.css') }}">
			<link rel="stylesheet" type="text/css" href="{{ asset('styles/single_responsive.css') }}">
		@endif
		
		@if(Route::is('Agents.index'))
			<link rel="stylesheet" type="text/css" href="{{ asset('styles/users.css') }}">
		@endif
		@if(Route::is('Completion_compte.index'))
			<link rel="stylesheet" type="text/css" href="{{ asset('styles/completion.css') }}">
		@endif
		@if(Route::is('Profil.index'))
			<link rel="stylesheet" type="text/css" href="{{ asset('styles/profil-index.css') }}">
		@endif
		@if(Route::is('Profil.edit'))
			<link rel="stylesheet" type="text/css" href="{{ asset('styles/profil-edit.css') }}">
		@endif
		@if(Route::is('Mot_de_passe.index'))
			<link rel="stylesheet" type="text/css" href="{{ asset('styles/password_edit.css') }}">
		@endif
	</head>

	<body>

		<div class="super_container">

			<!-- Header -->

			<header class="header trans_300">

				<!-- Top Navigation -->

				<div class="top_nav">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="top_nav_left">livraison gratuit sur toutes vos commandes</div>
							</div>
							<div class="col-md-6 text-right">
								<div class="top_nav_right">
									<ul class="top_nav_menu">

										<!-- Currency / Language / My Account -->

										<li class="currency">
											<a href="#">
												usd
												<i class="fa fa-angle-down"></i>
											</a>
											<ul class="currency_selection">
												<li><a href="#">cad</a></li>
												<li><a href="#">aud</a></li>
												<li><a href="#">eur</a></li>
												<li><a href="#">gbp</a></li>
											</ul>
										</li>
										@auth
										<li class="language">
											<a href="">
												Gestion
												<i class="fa fa-angle-down"></i>
											</a>
											<ul class="language_selection">
												<li><a href="{{ route('Agents.index') }}">Agents</a></li>
												<li><a href="#">Finition</a></li>
												<li><a href="#">German</a></li>
												<li><a href="#">Spanish</a></li>
											</ul>
										</li>
										@endauth
										<li class="account">
											@guest
											<a href="#">
												My Account
												<i class="fa fa-angle-down"></i>
											</a>
											@endguest
											@auth
											<a href="#">
												{{ Auth::user()->email }}
												<i class="fa fa-angle-down"></i>
											</a>
											@endauth
											<ul class="account_selection">
												@guest
												<li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>

												<li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
												@endguest
												@auth
						                        	<form method="POST" action="{{ route('logout') }}">
							                            @csrf

							                            <a href=""><button type="submit">Deconnexion</button></a>
							                        </form>
							                    @endauth

											</ul>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Main Navigation -->

				<div class="main_nav_container">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 text-right">
								<div class="logo_container">
									<a href="#"><span>MDL</span>BUSINESS</a>
								</div>
								<nav class="navbar">
									<ul class="navbar_menu">
										<li><a href="categories.html">apropos</a></li>
										<li><a href="clients.html">clients</a></li>
										<li><a href="admin.html">Admin</a></li>
									</ul>
									<ul class="navbar_user">
										<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
										<li><a href="{{ route('Profil.index') }}"><i class="fa fa-user" aria-hidden="true"></i></a></li>
										@auth
											<li class="checkout">
												<a href="{{ route('Panier.index') }}">
													<i class="fa fa-shopping-cart" aria-hidden="true"></i>
													<span id="checkout_items" class="checkout_items">
													@if(Auth::user()->role_id == 1)
													@endif
													@if(Auth::user()->role_id == 5)
													{{ $notification }}
													@endif
													</span>
												</a>
											</li>
										@endauth
									</ul>
									<div class="hamburger_container">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>

			</header>

			<div class="fs_menu_overlay"></div>
			<div class="hamburger_menu">
				<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
				<div class="hamburger_menu_content text-right">
					<ul class="menu_top_nav">
						<li class="menu_item has-children">
							<a href="#">
								usd
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="menu_selection">
								<li><a href="#">FC</a></li>
								<li><a href="#">USD</a></li>
							</ul>
						</li>
						<li class="menu_item has-children">
							<a href="#">
								English
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="menu_selection">
								<li><a href="#">French</a></li>
								<li><a href="#">Italian</a></li>
								<li><a href="#">German</a></li>
								<li><a href="#">Spanish</a></li>
							</ul>
						</li>
						<li class="menu_item has-children">
							<a href="#">
								Mon compte
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="menu_selection">
								<li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Connexion</a></li>
								<li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Inscription</a></li>
							</ul>
						</li>
						<li class="menu_item"><a href="#">shop</a></li>
						<li class="menu_item"><a href="#">promotion</a></li>
						<li class="menu_item"><a href="#">pages</a></li>
						<li class="menu_item"><a href="#">blog</a></li>
						<li class="menu_item"><a href="#">contact</a></li>
					</ul>
				</div>
			</div>

			<!-- Slider -->

			

			<!-- LES BODY -->

			@yield('body-home')

			<!-- COMPLETION DU COMPTE -->
			@yield('body-completion')

			<!-- Body users -->
			@yield('body-users')

			<!-- BODY PROFIL -->
			@yield('body-profil-index')
			@yield('body-profil-edit')
			@yield('body-password-edit')

			<!-- ARTICLE -->
			@yield('body-article-show')
			@yield('body-article-edit')

			<!-- ARTICLE -->
			@yield('body-article-panier')

			<!-- ENDBODY -->

			<!-- Footer -->

		</div>

			<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
			<script src="{{ asset('styles/bootstrap4/popper.js') }}"></script>
			<script src="{{ asset('styles/bootstrap4/bootstrap.min.js') }}"></script>
			<script src="{{ asset('plugins/Isotope/isotope.pkgd.min.js') }}"></script>
			<script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
			<script src="{{ asset('plugins/easing/easing.js') }}"></script>
			<script src="{{ asset('js/custom.js') }}"></script>
		
			@if(Route::is('Articles.show'))
			<script src="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
			<script src="{{ asset('js/single_custom.js') }}"></script>
			@endif

	</body>

</html>
<?php
	use Illuminate\Support\Facades\Session;
	Session::forget('erreur');
	Session::forget('succes');
?>