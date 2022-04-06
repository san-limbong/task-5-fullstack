<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index()
    {
        $data = Article::paginate(2);
        if($data){
            return response()->json([
                "message" => "Retrieve data success",
                "data" => $data
            ], 200);
        }
        else
            return response()->json([
                "message" => "Data Not Found"
            ], 404);
    }

    public function show($id){
        $data = Article::find($id);
        if($data){
            return response()->json([
                "message" => "Retrieve data with id success",
                "data" => $data
            ], 200);
        }
        else
            return response()->json([
                "message" => "Data Not Found"
            ], 404);
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'title' => 'required',
            'content'=>'required',
            'image' => 'required',
            'category_id'=> 'required',
            'user_id' => 'required',
        ]);
        
        if ($validateData->fails()) {
            return response()->json([
                "message" => "Bad Request",
                "data" => $validateData->errors()
            ], 400);
        }

        $article=new Article();
        $article->image = $request->image;
        $article->image = $request->image;
        $article->user_id = $request->user_id;
        $article->category_id = $request->category_id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();

        return response()->json(
            [
            "message" => "New article has been added!",
            "data" => $article,
            ], 200);
    }

    public function update(Request $request, $id)
    {
        if($article = Article::find($id))
        {   

            $validateData = Validator::make($request->all(), [
                'title' => 'required',
                'content'=>'required',
                'image' => 'required',
                'category_id'=> 'required',
                'user_id' => 'required',
            ]);
            
            if ($validateData->fails()) {
                return response()->json([
                    "message" => "Bad Request",
                    "data" => $validateData->errors()
                ], 400);
            }

            $title = $request->title;
            $content = $request->content;
            $image = $request->image;
            $category_id = $request->category_id;
            $user_id = $request->user_id;

            $article->title = $title;
            $article->content = $content;
            $article->image = $image;
            $article->category_id = $category_id;
            $article->user_id = $user_id;
            $article->save();

            return response()->json([
                "message" => "Update data success",
                "data" => $article], 201);
        }
        else
            return response()->json(["message" => "Data Not Found"], 404);
    }


    public function destroy($id){
        if($data = Article::find($id))
        {
            $data->delete();
            return response()->json([
                "message" => "Delete data success",
                ], 200);
        }
        else
            return response()->json([
                "message" => "Data Not Found"
            ], 404);
    }

}
