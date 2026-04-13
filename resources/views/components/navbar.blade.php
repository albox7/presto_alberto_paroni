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
					<a class="nav-link {{ request()->routeIs('article.index') ? 'active' : '' }}" {{ request()->routeIs('article.index') ? 'aria-current="page"' : '' }} href="{{ route('article.index') }}">{{ __('ui.navArticles') }}</a>
				</li>
				

				{{-- Categorie --}}
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false">
						{{ __('ui.navCategories') }}
					</a>
					<ul class="dropdown-menu">
						@foreach ($categories as $category)
							<li>
								<a class="dropdown-item" href="{{ route('byCategory', ['category' => $category]) }}">
									{{ __("ui.{$category->name}") }}
								</a>
							</li>
						@endforeach
					</ul>
				</li>
				

				{{-- Login e Registrazione --}}
				@auth
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person-fill"></i> {{ __('ui.hello') }} {{ Auth::user()->name }}!
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="{{ route('create.article') }}">
									{{ __('ui.publicArticle') }}
								</a>
							</li>
							<li>
								<form action="{{ route('logout') }}" method="POST">
									@csrf
									<button type="submit" class="dropdown-item">
										{{ __('ui.navExit') }}
									</button>
								</form>
							</li>
						</ul>
					</li>
				@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person-fill"></i>
							{{ __('ui.navEnter') }}
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li>
								<a class="dropdown-item" href="{{ route('login') }}">
									{{ __('ui.login') }}
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="{{ route('register') }}">
									{{ __('ui.registration') }}
								</a>
							</li>
						</ul>
					</li>
				@endauth

				{{-- Revisore --}}
				@auth
					@if (Auth::user()->is_revisor)
						<li class="nav-item">
							<a class="nav-link btn btn-outline-success btn-sm position-relative w-sm-25" href="{{ route('revisor.index') }}">
								{{ __('ui.revArea') }}
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-accent">
									{{ \App\Models\Article::toBeRevisedCount() }}
								</span>
							</a>
						</li>
					@endif
				@endauth

			</ul>

			{{-- Search --}}
			<form class="d-flex ms-auto search" role="search" action="{{ route('article.search') }}" method="GET">
				<div class="input-group">
				<input type="search" name="query" class="form-control" placeholder="{{ __('ui.navSearchPlaceholder') }}" aria-label="search">
					<button type="submit" class="input-group-text" id="basic-addon2">
						{{ __('ui.navSearchBtn') }}
					</button>
				</div>
			</form>

			{{-- Languages --}}
			<div class="ms-lg-3 ms-0 d-flex">
				<x-_locale lang="it" />
				<x-_locale lang="gb" />
				<x-_locale lang="es" />
			</div>

		</div>	
	</div>
</nav>
