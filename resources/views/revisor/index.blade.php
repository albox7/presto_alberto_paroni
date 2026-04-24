<x-layout>
	<div class="container-fluid">
		<div class="row">
			<div class="col-auto">
				<h1>
					{{ __('ui.revArea' )}}
				</h1>
			</div>
		</div>
		
		@if (session()->has('message'))
			<div class="row">
				<div class="col-auto alert alert-success text-center rounded mx-2">
					{{ session('message') }}
				</div>
			</div>
		@endif
		
		@if ($article_to_check)
			<div class="row pt-5 gap-3">
				<div class="col-mx-auto col-md-5 col-lg-5 mt-3">
					<div class="row">
						@if ($article_to_check->images->count())
							
							{{-- Controllo immagini Google Vision --}}

							@foreach ($article_to_check->images as $key => $image)
								<div class="row revisor">
									<div class="col-12">
										<div class="row row-child">
											<div class="card">
												<div class="row">
													
													{{-- Immagine --}}
													<div class="col-12 col-md-4 col-lg-4">
														<img src="{{ $image->getUrl(600, 600) }}" class="img-fluid rounded" alt="Immagine {{ $key + 1 }} dell'articolo '{{ $article_to_check->title }}'">
													</div>
													
													{{-- Labels --}}
													<div class="col-12 col-md-4 col-lg-5">
														<div class="card-body no-border">
															<h5 class="strong">Labels</h5>
															@if ($image->labels)
																@foreach ($image->labels as $label)
																	#{{ $label }},
																@endforeach
															@else
																<p>No labels</p>
															@endif
														</div>
													</div>

													{{-- Ratings --}}
													<div class="col-12 col-md-4 col-lg-3">
														<div class="card-body no-border">
															<h5 class="strong">Ratings</h5>
															<div class="row">
																<ul class="revisor">
																	<li class="{{ $image->adult }}"> Adult</li>
																	<li class="{{ $image->violence }}"> Violence</li>
																	<li class="{{ $image->spoof }}"> Spoof</li>
																	<li class="{{ $image->racy }}"> Racy</li>
																	<li class="{{ $image->medical }}"> Medical</li>
																</ul>
															</div>															
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							
							{{-- END Controllo immagini Google Vision --}}


						@else
							<div class="col-6 col-md-4 mb-4 text-center">
								<p>
									Nessuna immagine
								</p>
							</div>
						@endif
					</div>
				</div>				
				<div class="col-12 col-md-6 col-lg-6 d-flex flex-column justify-content-between">
					<div>
						<div class="form-label accent mt-3">
							{{ __('ui.articleTitle') }}
						</div>
						<h2 class="mb-3">
							{{ $article_to_check->title }}
						</h2>
						<hr>
						<div class="row gap-3 justify-content-between">
							<div class="col-auto d-flex gap-5">
								<div>
									<div class="form-label accent">
										{{ __('ui.articleAuthor' )}}
									</div>
									<div>{{ $article_to_check->user->name }}</div>
								</div>
								<div>
									<div class="form-label accent">
										{{ __('ui.articlePrice2') }}
									</div>
									<div>{{ $article_to_check->price }} €</div>
								</div>
								<div>
									<div class="form-label accent">
										{{ __('ui.articleCategory') }}
									</div>
									<div>{{ $article_to_check->category->name }}</div>
								</div>
							</div>
							<div class="col-auto">
								<div class="d-flex gap-4">
									<form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
										@csrf
										@method('PATCH')
										<button class="btn btn-danger py-2 px-5">
											{{ __('ui.articleBAD' )}}
										</button>
									</form>
									<form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
										@csrf
										@method('PATCH')
										<button class="btn btn-success py-2 px-5">
											{{ __('ui.articleOK' )}}
										</button>
									</form>
								</div>
							</div>
						</div>					
						<hr>
						<div class="form-label accent mt-4">
							{{ __('ui.articleMessage' )}}
						</div>
						<p class="mt-2">
							{!! nl2br(e($article_to_check->description)) !!}
						</p>
					</div>					
				</div>
			</div>
		@else
			
			{{-- Articoli da revisionare --}}
			<div class="row mb-5">
				<div class="col-auto">
					<h3>
						{{ __('ui.articleNone' )}}
					</h3>
				</div>
			</div>

			{{-- Articoli da cancellare --}}
			<div class="row mb-5">
				<div class="col-12">
					<hr class="mb-5">
					<h4>
						{{ __('ui.manageArticleTitle' )}}
					</h4>
					<div>
						{{ __('ui.manageArticleText' )}}
					</div>
				</div>
			</div>


			{{-- Cards --}}
			<div class="row cards-row">
				@forelse ($published_articles as $article)
					<div class="col-12 col-md-4 col-lg-3">
						<div class="position-relative">
							<x-card :article="$article" />
							<div class="d-flex gap-2 position-absolute top-0 end-0 px-4 py-3">
								<form action="{{ route('revisor.backToReview', $article) }}" method="POST">
									@csrf
									@method('PATCH')
									<button class="btn btn-sm btn-neutral">Riporta in revisione</button>
								</form>
								<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $article->id }}">
									Elimina
								</button>
							</div>

							{{-- Modale conferma eliminazione --}}
							<div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Conferma eliminazione</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											Sei sicuro di voler eliminare definitivamente l'articolo <strong>{{ $article->title }}</strong>?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
											<form action="{{ route('revisor.deleteArticle', $article) }}" method="POST">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger">Conferma</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							{{-- END Modale conferma eliminazione --}}

						</div>
					</div>
				@empty
					<div class="col-12">
						<p class="fst-italic">Nessun articolo pubblicato</p>
					</div>
				@endforelse

				<div class="d-flex justify-content-center mt-4">
					{{ $published_articles->links() }}
				</div>
				
			</div>

		@endif
	</div>
</x-layout>