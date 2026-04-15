<div>
	
	@if (session()->has('success'))
		<div class="alert alert-success text-center">
			{{ session('success') }}
		</div>
	@endif

	<form wire:submit="store">
		<div class="mb-3">
			<label for="title" class="form-label">
				{{ __('ui.articleTitle') }}
			</label>
			<input type="text" autofocus class="form-control custom-input @error('title') is-invalid @enderror" id="title" wire:model.blur="title">
			@error('title')
				<p class="text-danger">{{ $message }}</p>
			@enderror
		</div>


		{{-- Immagini --}}
		<div class="mb-3">
			<label for="image" class="form-label">
				{{ __('ui.articleImage') }}
			</label>
			
			<input id="image" type="file" wire:model.live="temporary_images" multiple
			class="form-control custom-input-file @error('temporary_images.*') is-invalid @enderror {{ count($images) >= \App\Livewire\CreateArticleForm::MAX_IMAGES ? 'disabled' : '' }}"
			placeholder="Img/"
			{{ count($images) >= \App\Livewire\CreateArticleForm::MAX_IMAGES ? 'disabled' : '' }}>

			{{-- Errore MAX_IMAGES --}}
			@if (count($images) >= \App\Livewire\CreateArticleForm::MAX_IMAGES)
				<p class="fst-italic text-danger">{{ __('ui.maxImages') }}</p>
			@endif

			@error('temporary_images.*')
				<p class="text-danger">{{ $message }}</p>
			@enderror

			@error('temporary_images')
				<p class="text-danger">{{ $message }}</p>
			@enderror

		</div>
		@if (!empty($images))
			<div class="row">
				<div class="col-12">
					<label class="form-label">Preview immagini</label>
					<div class="row wrapper-img-preview">
						@foreach ($images as $index => $image)
							<div class="col-auto img-preview-wrapper">
								<div class="img-preview custom-input" style="background-image: url({{ $image->temporaryUrl() }});"></div>
								<button type="button" class="btn btn-delete-thumbnail" wire:click="removeImage({{ $index }})"></button>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endif
		{{-- END Immagini --}}


		<div class="mb-3">
			<label for="description" class="form-label">
				{{ __('ui.articleDescription') }}
			</label>
			<textarea id="description" cols="30" rows="8"
				class="form-control textarea @error('description') is-invalid @enderror" wire:model.blur="description"></textarea>
			@error('description')
				<p class="text-danger">{{ $message }}</p>
			@enderror
		</div>
		<div class="mb-3">
			<label for="price" class="form-label">
				{{ __('ui.articlePrice') }}
			</label>
			<input type="text" class="form-control custom-input @error('price') is-invalid @enderror" id="price"
				wire:model.blur="price">
			@error('price')
				<p class="text-danger">{{ $message }}</p>
			@enderror
		</div>
		<div>
			<label for="category" class="form-label">
				{{ __('ui.articleCategory') }}
			</label>
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
			<button type="submit" class="btn btn-primary-custom w-100">
				{{ __('ui.articleSubmit') }}
			</button>
		</div>
	</form>
</div>

