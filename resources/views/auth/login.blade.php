<x-layout title="Accedi">

	<div class="container-fluid extra-padding-container">

		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4">
				<h1>Accedi</h1>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4 mt-3 mb-5">
				<form method="POST" action="{{route('login')}}">
					@csrf
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" autofocus class="form-control custom-input" id="email" aria-describedby="emailHelp">
					</div>

					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" name="password" class="form-control custom-input" id="password">
					</div>

					<div>
						<button type="submit" class="mt-3 btn btn-primary-custom w-100">Accedi</button>
					</div>

				</form>
			</div>
		</div>

	</div>

</x-layout>