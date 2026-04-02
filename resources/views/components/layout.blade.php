<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $title ?? 'App' }}</title>
		<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body>

		{{-- NAVBAR --}}
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
			<div class="container-fluid">
				<a class="navbar-brand" href="{{ route('home') }}">Brand</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" {{ request()->routeIs('home') ? 'aria-current="page"' : '' }} href="{{ route('home') }}">Home</a>
						</li>
					</ul>
					<ul class="navbar-nav ms-auto">
						@auth
							<li class="nav-item">
								<form action="{{ route('logout') }}" method="POST">
									@csrf
									<button type="submit" class="btn btn-link nav-link">Esci</button>
								</form>
							</li>
						@endauth
						@guest
							<li class="nav-item">
								<a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Registrati</a>
							</li>
							<li class="nav-item">
								<a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Accedi</a>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		{{-- CONTENUTO --}}
		<main>
			{{ $slot }}
		</main>

		{{-- FOOTER --}}
		<footer>
			<div class="container-fluid">
				<p>&copy; {{ date('Y') }} - App</p>
			</div>
		</footer>

	</body>
</html>
