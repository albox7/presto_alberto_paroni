<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\ResizeImage;
use App\Jobs\RemoveFaces;
use Livewire\Component;
use App\Models\Article;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;


class CreateArticleForm extends Component
{
	use WithFileUploads;

	// Costante per numero massimo di immagini per articolo
	const MAX_IMAGES = 6;

	#[Validate('required|min:5')]
	public $title;
	#[Validate('required|min:10')]
	public $description;
	#[Validate('required|numeric')]
	public $price;
	#[Validate('required')]
	public $category = '';
	public $article;

	public $images = [];
	public $temporary_images;


	public function store() {

		$this->price = str_replace(',', '.', $this->price);
		$this->validate();
		$this->article = Article::create([
			'title'       => $this->title,
			'description' => $this->description,
			'price'       => $this->price,
			'category_id' => $this->category,
			'user_id'     => Auth::id()
		]);

		// Se c'è almeno una immagine la salva nel path
		if (count($this->images) > 0) {
			foreach ($this->images as $image) {
				$newFileName = "articles/{$this->article->id}";
				$newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
				RemoveFaces::withChain([
					new ResizeImage($newImage->path, 600, 600),
					new GoogleVisionSafeSearch($newImage->id),
					new GoogleVisionLabelImage($newImage->id)
				])->dispatch($newImage->id);
			}
			File::deleteDirectory(storage_path('/app/livewire-tmp'));
		}

		// Rimuovoe tutti i valori inseriti nel form
		$this->reset();

		// Confirm message
		session()->flash('success', 'Articolo creato correttamente');
	}


	// Converte la virgola nei decimali con il punto
	public function updatedPrice() {
		$this->price = str_replace(',', '.', $this->price);
		$this->validateOnly('price');
	}
	
	// Messaggi custom
	public function messages() {
		
		return [
			'title.required' => __('ui.titleRequired'),
			'title.min' => __('ui.titleMin'),
			'description.required' => __('ui.descriptionRequired'),
			'description.min' => __('ui.descriptionMin'),
			'price.required' => __('ui.priceRequired'),
			'price.numeric' => __('ui.priceNumeric'),
			'category.required' => __('ui.categoryRequired'),
			'temporary_images' => __('ui.maxImages'),
		];
	}

	// Gestione delle immagini: peso e numero (max 6 per articolo)
	public function updatedTemporaryImages()
	{

		// Valida solo le immagini senza resettare 
		// gli errori degli altri campi
		$this->validateOnly('temporary_images.*', [
			'temporary_images.*' => 'image|max:1024',
		]);
		$this->validateOnly('temporary_images', [
			'temporary_images' => 'max:' . self::MAX_IMAGES
		]);

		foreach ($this->temporary_images as $image) {
			if (count($this->images) < self::MAX_IMAGES) {
				$this->images[] = $image;
			}
		}
	}

	// Cancella le immagini SIA nell'array CHE IN storage/livewire-tmp/
	public function removeImage($index) {
		if (in_array($index, array_keys($this->images))) {
			$this->images[$index]->delete();
			unset($this->images[$index]);
		}
	}


	public function render()
    {
        return view('livewire.create-article-form');
    }
}
