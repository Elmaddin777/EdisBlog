<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator as Val;
use Str;
// Models
use App\Models\Category as Cat;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\ConfigModels as Config;
// Mail
use Mail;

class HomeController extends Controller
{
    public function __construct(){
        if (Config::find(1)->status == 0){
          return die('<h1> Website is temporarily deactivated  ): </h1>');
        }
      
      
        // Share often needed data with all views 
        view()->share('nav_items', Page::orderBy('order', 'ASC')->get());
        view()->share('categories', Cat::whereStatus(1)->inRandomOrder()->get() );
    }
    
    public function homepage(){
      $data = [
        'articles' => Article::with('getCategory')->whereStatus(1)->whereHas('getCategory' , function($query){
            $query->whereStatus(1);
        })->orderBy('created_at', 'desc')->paginate(5)
      ];
      
      return view('front.homepage', $data);
    }
    
    public function single($cat, $slug){
      // Get category
      $category = Cat::whereSlug($cat)->first() ?? abort(403, 'No such content ):');
      // Get data from article table
      $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'No such content ):');
      // Then increase 'hit' number
      $article->increment('hit');
      
      $data = [
        'articles' => $article,
      ];
      
      return view('front.single', $data);
    }
    
    public function category($cat_slug){
      $category = Cat::whereSlug($cat_slug)->whereStatus(1)->first() ?? abort(403, 'No such category );');
      $count = Article::whereCategoryId($category->id)->whereStatus(1)->count();
    
      $article = Article::whereCategoryId($category->id)->whereStatus(1)->orderBy('created_at', 'desc')->simplePaginate(1) ?? abort(403, 'No such articles');    
      $data = [
        'category' => $category,
        'articles' => $article,
        'count' => $count
      ];
      
      return view('front.category', $data);
    }
    
    public function page($page_slug){
      $page = Page::whereSlug($page_slug)->first() ?? abort(403, 'No such page ):');
    
      $data = [
        'page' => $page
      ];
      
      return view('front.page', $data);
    }
    
    public function contact(){
      return view('front.contact');
    }
    
    public function contactStore(Request $request){
      // Make auth rules
      $rules = [
        'name' => 'required|min:5',
        'email' => 'required|email',
        'topic' => 'required',
        'message' => 'required|min:10'
      ];
      
      $validator = Val::make($request->all() , $rules);
      
      if ($validator->fails()) {
        return redirect()->route('contact')->withErrors($validator)->withInput();
      }
      
      // Store the data
      $contact = new Contact;
      $contact->name = $request->name;
      $contact->email = $request->email;
      $contact->topic = $request->topic;
      $contact->message = $request->message;
      $contact->save();
      
      // Send fake mail via mailtrap.io
      $mail = Contact::whereId($contact->id)->first();
      
      $data = [
        'email' => $mail,
        'name' => $request->name,
        'message' => $request->message
      ];
      
  
      Mail::send('front.mail', $data, function($message) use($request){
        $message->from('ediportfoliomessage@gmail.com');
        $message->to('memisove@gmail.com');
        $message->subject($request->name.' has sent a message');
      });
      
      // All ok success
      return redirect()->route('contact')->with('success', 
                              'Thank you for contacting with us! We will get in touch with you ASAP');
    }
}

















