<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index',compact('categories'));
        
    }

    public function show(Category $category)
    {
        return view('category.show', [
            'articles' => $category->articles,
            'title' => $category->name,
            'id' => $category->id
        ]);
    }

    public function create()
    {   
        $this->authorize('admin');
        return view('category.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required',
        ]);
        $category=new Category();
        $category->user_id = auth()->user()->id;
        $category->name = $request->name;
        $category->save();
        return redirect('/categories')->with('success', 'New category has been added!');
    }

    public function edit(Category $category)
    {   
        $this->authorize('admin');
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = Category::findOrFail($id);
        $category->user_id = auth()->user()->id;
        $category->name = $request->name;
        $category->save();
        return redirect('/categories')->with('info', 'Category has been updated!');
    }

    public function destroy($id)
    {   
        $this->authorize('admin');
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/categories')->with('danger', 'Category has been deleted!');

    }
}
