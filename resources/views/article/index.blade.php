<x-layout>
	<div class="container-fluid">
		<div class="row height-custom">
			<div class="col-12">
				<h1>{{ __('ui.allArticles') }}</h1>
			</div>
		</div>
		<div class="row height-custom align-items-stretch py-5 cards-row">
			@forelse ($articles as $article)
				<div class="col-12 col-md-6 col-lg-3">
					<x-card :article="$article" />
				</div>
			@empty
				<div class="col-12">
					<h3>
						{{ __('ui.voidArticles') }}
					</h3>
				</div>
			@endforelse
		</div>
		<div class="d-flex justify-content-center">
			<div>
				{{ $articles->links() }}
			</div>
		</div>
	</div>
</x-layout>