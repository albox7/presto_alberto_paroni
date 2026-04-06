<x-layout>
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<h1>
					{{ $category->name }}
				</h1>
			</div>
		</div>
		<div class="row height-custom align-items-stretch py-5 cards-row">
			@forelse ($articles as $article)
				<div class="col-12 col-md-6 col-lg-3">
					<x-card :article="$article" />
				</div>
			@empty
				<div class="col-auto">
					<h3>
						Non ci sono articoli in questa categoria...
					</h3>
					@auth
						<a class="btn btn-primary-accent my-5" href="{{ route('create.article') }}">
							Pubblica un articolo
						</a>
					@endauth
				</div>
			@endforelse
		</div>
	</div>
</x-layout>