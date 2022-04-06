<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $request)
    {  
        if($request->has('search')){
            $articles = Article::where('title','LIKE','%' .$request->search.'%')
            ->orWhere('content', 'LIKE', '%' . $request->search . '%')
            ->paginate(5);
            $articles->appends($request->all());
        }
        else{
            $articles = Article::latest()->paginate(7);
        }     
        return view ('articles',compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article',compact('article'));
    }

}