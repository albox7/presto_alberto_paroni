<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;


class PublicController extends Controller
{
    public function homepage() {

		$articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(6);
        return view('index', compact('articles'));
    }

	public function setLanguage($lang) {

		//dd($lang);

		// Mapping necessario perché il codice bandiera 'gb' non corrisponde
		// al codice cartella lingua 'uk' usato per le traduzioni:
		// in pratica non c'è una bandiera uk negli svg ...
		$localeMap = [
			'gb' => 'uk',
		];
		$locale = $localeMap[$lang] ?? $lang;

		//dd($locale);

		session()->put('locale', $locale);
		return redirect()->back();
	}

}
