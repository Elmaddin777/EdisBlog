<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Article;
use App\Models\Category;

// Upload
use App\Traits\UploadTrait;

class ArticlesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'ASC')->get();
        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'title' => 'min:3',
          'article_image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048'
        ]);
    
        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = str_slug($request->title);
        
        // Check if article image has been uploaded
        if ($request->has('article_image')) {
          // Image namespace
          $image_name = str_slug($request->title).'_'.time().'.'.$request->article_image->getClientOriginalExtension();
          // Store image
          $request->article_image->move(public_path('admin/uploads'), $image_name);
          // Insert name to db
          $article->image = 'uploads/'.$image_name; 
        }
        
        $article->save();
        toastr()->success('Article has been created successfully!');
        return redirect()->route('articles.index');
        
    }
    
    public function switch(Request $request){
      // Request data from bootstrap toggle in index
      $article = Article::findOrFail($request->id);
      $article->status = $request->state=='true' ? 1 : 0;
      $article->save();
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('back.articles.edit', compact('categories'), compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'title' => 'min:3',
        'article_image' => 'image|mimes:jpg,png,jpeg,gif|max:2048'
      ]);
      
      $article = Article::findOrFail($id);
      $article->title = $request->title;
      $article->category_id = $request->category;
      $article->content = $request->content;
      $article->slug = str_slug($request->title);
      
      // Check if article image has been uploaded
      if ($request->has('article_image')) {
        // Image namespace
        $image_name = str_slug($request->title).'_'.time().'.'.$request->article_image->getClientOriginalExtension();
        // Store image
        $request->article_image->move(public_path('admin/uploads'), $image_name);
        // Insert name to db
        $article->image = 'uploads/'.$image_name; 
      }
      
      $article->save();
      
      toastr()->success('Article has been updated successfully!');
      return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // The form that send data to this function must be 'delete' method
      $article = Article::findOrFail($id);
      $article->delete();
      toastr()->success('Article has been moved to "Deleted Article" table');
      return redirect()->route('articles.index');
    
    }
    
    public function trashed(){
      $articles = Article::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
      return view('back.articles.trash', compact('articles'));
    }
    
    public function restoreTrashedArticle($id){
      $article = Article::onlyTrashed()->find($id)->restore();
      toastr()->success('Article restored successfully!');
      return redirect()->route('articles.index');
    }
    
    public function deleteTrashedArticle($id){
      $article = Article::onlyTrashed()->find($id)->forceDelete();
      toastr()->success('Article has been removed permanently');
      return redirect()->route('trashed');
    }
}










