<div class="card h-100">
	
	<div class="card-img-wrapper">
		<img class="img-fluid" src="https://picsum.photos/200" alt="Immagine dell'articolo {{ $article->title }}">
		<div class="article-price">
			<h6>{{ $article->price }} €</h6>
		</div>
	</div>	

	<div class="card-body">
		<h4>
			<a href="{{ route('article.show', compact('article')) }}">
				{{ $article->title }}
			</a>
		</h4>
	</div>
	
	<div class="card-footer">
		<a href="{{ route('byCategory', ['category' => $article->category]) }}">
			{{ __("ui.{$article->category->name}") }}
		</a>
	</div>
</div>