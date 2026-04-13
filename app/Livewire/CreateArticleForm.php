<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;


class CreateArticleForm extends Component
{
	#[Validate('required|min:5')]
	public $title;
	#[Validate('required|min:10')]
	public $description;
	#[Validate('required|numeric')]
	public $price;
	#[Validate('required')]
	public $category = '';
	public $article;


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
		
		// return [
		// 	'title.required'      => 'Il titolo è obbligatorio',
		// 	'title.min'           => 'Il titolo deve essere composto da almeno 5 caratteri',
		// 	'description.required' => 'La descrizione è obbligatoria',
		// 	'description.min'     => 'La descrizione deve essere composta da almeno 10 caratteri',
		// 	'price.required'      => 'Indicare un prezzo',
		// 	'price.numeric'       => 'Il prezzo deve essere un numero',
		// 	'category.required'   => 'Seleziona una categoria',
		// ];

		return [
			'title.required' => __('ui.titleRequired'),
			'title.min' => __('ui.titleMin'),
			'description.required' => __('ui.descriptionRequired'),
			'description.min' => __('ui.descriptionMin'),
			'price.required' => __('ui.priceRequired'),
			'price.numeric' => __('ui.priceNumeric'),
			'category.required' => __('ui.categoryRequired'),
		];
	}

    public function render()
    {
        return view('livewire.create-article-form');
    }
}
