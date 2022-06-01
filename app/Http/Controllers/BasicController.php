<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('myarticle.index', [
            'articles' => Article::where('user_id', auth()->user()->id)->get()
        ]);
    }
    
    public function show(Article $article)
    {
        return view('myarticle.show', [
            'article' => $article
        ]);
    }

    public function create()
    {
        return view('myarticle.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        // $datas=$request->all();
        // dd($datas);
        // ddd($request);
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'category_id'=> 'required',
            'content'=>'required'
        ]);

        $article=new Article();
        // $image=$request->image;
        $data=$request->image->hashName();
        // $filename=time().'.'.$image->getClientOriginalExtension();
        // $filename=$data.'.'.$image->getClientOriginalExtension();
        // $filename=$data;
        
        $request->image->move('assets',$data);
        // $request->image->move('assets',$filename);
        $article->image=$data;
        // $article->image=$filename;
        $article->user_id = auth()->user()->id;
        $article->category_id = $request->category_id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();
    
        return redirect('/home')->with('success', 'New article has been added!');
    
    }

    public function edit(Article $article)
    {
        return view('myarticle.edit', [
            'article' => $article,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
            'category_id'=> 'required',
            'content'=>'required'
        ]);

        

        $article = Article::findOrFail($id);
        if ($request->file('image')) {
            if ($request->oldImage) {
                File::delete(public_path('assets/' . $article->image));
            }

            $data=$request->image->hashName();
            // $image=$request->image;
            // $data=$request->image->hashName();
            // $filename=time().'.'.$image->getClientOriginalExtension();
            // $filename=$data.'.'.$image->getClientOriginalExtension();
            // $request->image->move('assets',$filename);
            // $article->image=$filename;
            $request->image->move('assets',$data);
            $article->image=$data;
        }


        
        $article->user_id = auth()->user()->id;
        $article->category_id = $request->category_id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();

        return redirect('/home')->with('info', 'Article has been updated!');
    }
    

    public function destroy($id)
    {   
        $article = Article::findOrFail($id);
        File::delete(public_path('assets/' . $article->image));
        $article->delete();
        return redirect('/home')->with('warning', 'Article has been deleted!');
    }
}
