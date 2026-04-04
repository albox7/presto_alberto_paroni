<x-layout title="Registrati">

	<div class="container-fluid extra-padding-container">

		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4">
				<h1>Registrati</h1>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4 mt-3 mb-5">
				<form method="POST" action="{{route('register')}}">
					@csrf
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" autofocus class="form-control custom-input" id="email" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="name" class="form-label">Nome</label>
						<input type="text" name="name" class="form-control custom-input" id="name">
					</div>

					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" name="password" class="form-control custom-input" id="password">
					</div>

					<div class="mb-3">
						<label for="password_confirmation" class="form-label">Conferma password</label>
						<input type="password" name="password_confirmation" class="form-control custom-input" id="password_confirmation">
					</div>

					<div>
						<button type="submit" class="mt-3 btn btn-primary-custom w-100">Registrati</button>
					</div>

				</form>
			</div>
		</div>
	</div>

</x-layout>