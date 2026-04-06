<x-layout>
	<div class="container">
		<div class="row py-3 gap-4">
			<div class="col-12 col-md-6 col-lg-6 mb-3 mt-3">
				<div id="carouselExample" class="carousel slide">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="https://picsum.photos/400" class="d-block w-100 shadow" alt="...">
						</div>
						<div class="carousel-item">
							<img src="https://picsum.photos/400" class="d-block w-100 shadow" alt="...">
						</div>
						<div class="carousel-item">
							<img src="https://picsum.photos/400" class="d-block w-100 shadow" alt="...">
						</div>
					</div>
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
				</div>
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