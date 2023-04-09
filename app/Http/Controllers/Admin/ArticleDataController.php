<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleDataController extends Controller
{
    public function index()
    {
        $number = 1;
        $articles = Article::latest()->get();
        return view('pages.admin.data.article.index', [
            'articles' => $articles,
            'number' => $number
        ]);
    }

    public function create()
    {
        return view('pages.admin.data.article.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title' => ['required', 'max:100'],
            'body' => ['required'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,PNG,JPG,JPEG', 'max:4000']
        ]);

        $validated_data['slug'] = SlugService::createSlug(Article::class, 'slug', $request->title);
        $validated_data['excerpt'] = Str::limit(strip_tags($request->body), 200);
        $validated_data['image'] = $request->title . '-' . time() . '.' . $request->image->extension();
        $request->image->move(public_path('articles'), $validated_data['image']);

        Article::create($validated_data);
        return redirect(route('admin.artikel'))->with('create_success', 'Data artikel berhasil ditambahkan!');
    }

    public function detail($id)
    {
        $article = Article::where('id', $id)->first();
        return view('pages.admin.data.article.detail', [
            'article' => $article,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->image != null) {
            $article_image = $request->title . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('articles'), $article_image);

            Article::where('id', $id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'image' => $article_image,
            ]);
        } else {
            Article::where('id', $id)->update([
                'title' => $request->title,
                'body' => $request->body,

            ]);
        }
        return redirect(route('admin.artikel'))->with('update_success', 'Data artikel berhasil diupdate!');
    }

    public function delete($id)
    {
        Article::where('id', $id)->delete();
        return redirect(route('admin.artikel'))->with('update_success', 'data artikel berhasil dihapus!');
    }
}
