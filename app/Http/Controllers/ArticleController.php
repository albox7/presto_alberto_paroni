<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Models\Article;
use App\Models\Category;


class ArticleController extends Controller implements HasMiddleware
{

	public function searchArticles(Request $request)
	{
		$query = $request->input('query');
		$articles = Article::search($query)->where('is_accepted', true)->paginate(2);
		$articles->appends(['query' => $query]);
		return view('article.searched', ['articles' => $articles, 'query' => $query]);
	}

	public static function middleware() : array {
		return [new Middleware('auth', only: ['create'])];
	}

    public function create() {
		return view('article.create');
	}

	public function index() {
		$articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(12);
		return view('article.index', compact('articles'));
	}

	public function show(Article $article) {
		return view('article.show', compact('article'));
	}

	public function byCategory(Category $category) {
		$articles = $category->articles->where('is_accepted', true);
		return view('article.byCategory', compact('articles', 'category'));
	}
	
}
