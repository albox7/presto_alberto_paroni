<x-layout>
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<h1>
					{{ __("ui.{$category->name}") }}
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
						{{ __('ui.voidCat') }}
					</h3>
					@auth
						<a class="btn btn-primary-accent my-5" href="{{ route('create.article') }}">
							{{ __('ui.publicArticle') }}
						</a>
					@endauth
				</div>
			@endforelse
		</div>
	</div>
</x-layout>