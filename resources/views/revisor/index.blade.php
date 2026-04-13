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
						@for ($i = 0; $i < 6; $i++)
							<div class="col-6 col-md-4 mb-4 text-center">
								<img src="https://picsum.photos/300" class="img-fluid rounded" alt="immagine segnaposto">
							</div>
						@endfor
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
									<div>{{ $article_to_check->price }}€</div>
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
			<div class="row">
				<div class="col-auto">
					<h3>
						{{ __('ui.articleNone' )}}
					</h3>
					<a href="{{ route('homepage') }}" class="mt-5 btn btn-primary-accent">
						{{ __('ui.backToHome' )}}
					</a>
				</div>
			</div>
		@endif
	</div>
</x-layout>