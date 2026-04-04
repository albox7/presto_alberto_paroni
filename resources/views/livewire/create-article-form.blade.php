<div>
	
	@if (session()->has('success'))
		<div class="alert alert-success text-center">
			{{ session('success') }}
		</div>
	@endif

	<form wire:submit="store">
		<div class="mb-3">
			<label for="title" class="form-label">Titolo</label>
			<input type="text" autofocus class="form-control custom-input @error('title') is-invalid @enderror" id="title" wire:model.blur="title">
			@error('title')
				<p class="text-danger">{{ $message }}</p>
			@enderror
		</div>
		<div class="mb-3">
			<label for="description" class="form-label">Descrizione</label>
			<textarea id="description" cols="30" rows="8"
				class="form-control textarea @error('description') is-invalid @enderror" wire:model.blur="description"></textarea>
			@error('description')
				<p class="text-danger">{{ $message }}</p>
			@enderror
		</div>
		<div class="mb-3">
			<label for="price" class="form-label">Prezzo &euro;</label>
			<input type="text" class="form-control custom-input @error('price') is-invalid @enderror" id="price"
				wire:model.blur="price">
			@error('price')
				<p class="text-danger">{{ $message }}</p>
			@enderror
		</div>
		<div class="mb-3">
			<label for="category" class="form-label">Categoria</label>
			<select id="category" wire:model.blur="category" class="form-control select @error('category') is-invalid @enderror">
				<option value="" selected disabled></option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
			@error('category')
				<p class="text-danger">{{ $message }}</p>
			@enderror
		</div>
		<div class="d-flex justify-content-center">
			<button type="submit" class="btn btn-primary w-100 mt-3">Pubblica articolo</button>
		</div>
	</form>
</div>

