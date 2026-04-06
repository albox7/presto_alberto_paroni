{{-- NAVBAR --}}
<nav id="navbar" class="navbar navbar-expand-lg">
	<div class="container-fluid">
		
		{{-- Logo --}}
		<a class="navbar-brand" href="{{ route('homepage') }}">
			<div class="logo-shadow logo-shadow-color"></div>
			<div class="logo logo-gradient"></div>
		</a>
		
		{{-- Toggle button --}}
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		{{-- Menu items --}}
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ms-auto">
				
				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}" {{ request()->routeIs('homepage') ? 'aria-current="page"' : '' }} href="{{ route('homepage') }}">Home</a>
				</li>

				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('article.index') ? 'active' : '' }}" {{ request()->routeIs('article.index') ? 'aria-current="page"' : '' }} href="{{ route('article.index') }}">Tutti gli articoli</a>
				</li>
				

				{{-- Categorie --}}
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false">
						Articoli per categoria
					</a>
					<ul class="dropdown-menu">
						@foreach ($categories as $category)
							<li>
								<a class="dropdown-item"
									href="{{ route('byCategory', ['category' => $category]) }}">{{ $category->name }}</a>
							</li>
						@endforeach
					</ul>
				</li>
				

				{{-- Login e Registrazione --}}
				@auth
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person-fill"></i> Ciao {{ Auth::user()->name }}!
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="{{ route('create.article') }}">Pubblica un articolo</a>
							</li>
							<li>
								<form action="{{ route('logout') }}" method="POST">
									@csrf
									<button type="submit" class="dropdown-item">
										Esci
									</button>
								</form>
							</li>
						</ul>
					</li>
				@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person-fill"></i>
							Accedi o registrati
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="{{ route('login') }}">Accedi</a></li>
							<li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
						</ul>
					</li>
				@endauth

				{{-- Revisore --}}
				@auth
					@if (Auth::user()->is_revisor)
						<li class="nav-item">
							<a class="nav-link btn btn-outline-success btn-sm position-relative w-sm-25" href="{{ route('revisor.index') }}">
								Area revisore
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-accent">
									{{ \App\Models\Article::toBeRevisedCount() }}
								</span>
							</a>
						</li>
					@endif
				@endauth

			</ul>
		</div>
				
	</div>
</nav>
