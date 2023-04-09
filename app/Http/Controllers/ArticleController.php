<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $latest_article = Article::latest()->first();
        $articles = Article::latest()->get();
        return view('pages.article.index', [
            'latest_article' => $latest_article,
            'articles' => $articles,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->keyword;
        $articles = Article::where('title', 'like', '%' . $search . '%')->orWhere('body', 'like', '%' . $search . '%')->get();
        return view('pages.article.index', [
            'articles' => $articles,
        ]);
    }

    public function read($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('pages.article.read', [
            'article' => $article,
        ]);
    }
}
