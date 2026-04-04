<x-layout>

	<div class="container-fluid">
		<div class="row">
			<div class="col text-center mt-5">
				<h1>Eccoci qua {{ Auth::user()?->name ?? '' }} 😎</h1>
			</div>			
			<div class="my-3 text-center">
				@auth
					<a class="btn btn-primary" href="{{ route('create.article') }}">
						Pubblica un articolo
					</a>
				@endauth
			</div>
		</div>
	</div>

</x-layout>