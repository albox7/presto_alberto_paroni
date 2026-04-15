<x-layout>
	<div class="container">
		<div class="row py-3 gap-4">

			<div class="col-12 col-md-6 mb-3">
				@if ($article->images->count() > 0)
					<div id="carouselExample" class="carousel slide mt-3">
						<div class="carousel-inner">
							@foreach ($article->images as $key => $image)
								<div class="carousel-item @if ($loop->first) active @endif">
									<img src="{{ Storage::url($image->path) }}" alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}">
								</div>
							@endforeach
						</div>
						@if ($article->images->count() > 1)
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
								data-bs-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
								data-bs-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</button>
						@endif
					</div>
				@else
					<img src="https://picsum.photos/300" class="d-block w-100 mt-3 default-img" alt="..." alt="Nessuna foto inserita dall'utente">
				@endif
			</div>
			
			<div class="col-12 col-md-5">
				
				<h1>
					{{ $article->title }}
				</h1>
				
				<hr class="mb-4">
				
				<p class="mb-4">
					{!! nl2br(e($article->description)) !!}
				</p>
				
				<hr class="pb-2">
				
				<p class="color-note">
					Prezzo: {{ $article->price }} €
				</p>

			</div>
		</div>
	</div>
</x-layout>