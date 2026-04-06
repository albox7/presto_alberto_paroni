<x-layout>

	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<h1>Ultimi articoli inseriti</h1>

				
				{{-- Messaggi di errore --}}
				@if (session()->has('errorMessage'))
					<div class="alert alert-danger text-center rounded w-50">
						{{ session('errorMessage') }}
					</div>
				@endif

				{{-- Messaggi di conferma --}}
				@if (session()->has('message'))
					<div class="row">
						<div class="col-auto alert alert-success text-center rounded">
							{{ session('message') }}
						</div>
					</div>
				@endif

			</div>			
			<div class="col-auto mt-2">
				@auth
					<a class="btn btn-primary-accent" href="{{ route('create.article') }}">
						Pubblica un articolo
					</a>
				@endauth
			</div>
		</div>
		<div class="row height-custom align-items-stretch py-5 cards-row">
			
			{{-- Card --}}
			@forelse ($articles as $article)
				<div class="col-12 col-md-6 col-lg-3">
					<x-card :article="$article" />
				</div>
			@empty
				<div class="col-auto">
					<h3>
						Non sono ancora stati creati articoli...
					</h3>
				</div>
			@endforelse
		</div>
	</div>

</x-layout>