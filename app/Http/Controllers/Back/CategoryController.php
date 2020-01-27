<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Category as Cat;
use App\Models\Article;

class CategoryController extends Controller
{ 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Cat::orderBy('created_at', 'ASC')->get();
        return view('back.category.index', compact('categories'));
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
          'category' => 'required|min:3'
        ]);
        
        // Check id category exists
        $is_exists = Cat::whereSlug(str_slug($request->category))->first();
      
        if (!$is_exists == null) {
          toastr()->error($request->category.' category already exists');
          return redirect()->route('categories.index');
        }
        
        // All ok then insert to db
        $category = new Cat;
        $category->name = $request->category;
        $category->slug = str_slug($category->name);
        $category->save();
        
        toastr()->success('New category has been created successfully');
        return redirect()->route('categories.index');
    }

    public function switch(Request $request){
      $category = Cat::findOrFail($request->id);
      $category->status = $request->state == 'true' ? 1 : 0;
      $category->save();
    }
        
    public function getCategoryData(Request $request){

      $category = Cat::findOrFail($request->id);
      return response()->json($category);
    }
    
    
    public function updateCategory(Request $request){
      
      $request->validate([
        'category' => 'required|min:3'
      ]);
      
      // Check id category exists
      $is_exists = Cat::whereSlug(str_slug($request->category))->first();
    
      if (!$is_exists == null) {
        toastr()->error($request->category.' category already exists');
        return redirect()->route('categories.index');
      }
      
      $category = Cat::findOrFail($request->id);
      
      // All ok then update
      $category->name = $request->category;
      $category->slug = str_slug($category->name);
      $category->save();
      
      toastr()->success('Category has been updated successfully');
      return redirect()->route('categories.index');
    }
    
    public function deleteCategory(Request $request){  
      // Get id of category
      $id = $request->hidden_cat_id;  
      
      // Find the relevant data
      $category = Cat::findOrFail($id);
    
  
      if ($id == 1) {
        toastr()->error('This category can not be deleted !');
        return redirect()->back();
      }
      
      $article_count = $category->getArticleCount();
      
      if ($article_count > 0) {
        Article::where('category_id', $category->id)->update(['category_id' => 1]);
        $default_cat = Cat::find(1);
        toastr()->success('Category has been deleted successfully. Remaining articles moved to category '.$default_cat->name);
        return redirect()->route('categories.index');
      }
      
      $category->delete();
      toastr()->success('Category has been deleted successfully !');
      return redirect()->route('categories.index');
      
      
    }
}







