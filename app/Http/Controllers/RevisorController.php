<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Mail\BecomeRevisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class RevisorController extends Controller
{
	
	public function index() {
		$article_to_check = Article::where('is_accepted', null)->first();
		$published_articles = Article::where('is_accepted', true)->orderBy('updated_at', 'desc')->paginate(12);
		return view('revisor.index', compact('article_to_check', 'published_articles'));
	}


	public function accept(Article $article) {
		$article->setAccepted(true);
		return redirect()->back()->with('message', "Hai accettato l'articolo $article->title");
	}

	public function reject(Article $article) {
		$article->setAccepted(false);
		return redirect()->back()->with('message', "Hai rifiutato l'articolo $article->title");
	}

	public function becomeRevisor() {
		Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
		return redirect()->route('homepage')->with('message', 'Complimenti, hai richiesto di diventare revisor!');
	}

	public function makeRevisor(User $user) {
		Artisan::call('app:make-user-revisor', ['email' => $user->email]);
		return redirect()->back();
	}

	// Riporta l'articolo in modalità "da revisionare"
	public function backToReview(Article $article) {
		$article->is_accepted = null;
		$article->save();
		return redirect()->back()->with('message', 'Articolo riportato in revisione');
	}

	// Elimina definitivamente un articolo
	public function deleteArticle(Article $article) {
		
		// Cancella fisicamente le immagini
		foreach ($article->images as $image) {
			Storage::disk('public')->deleteDirectory(dirname($image->path));
		}

		$article->delete();
		return redirect()->back()->with('message', 'Articolo eliminato definitivamente');
	}

}
