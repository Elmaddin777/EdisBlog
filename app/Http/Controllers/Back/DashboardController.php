<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Models
use App\Models\Category as Cat;
use App\Models\Article;
use App\Models\ConfigModels as Config;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function dashboard(){
      $article_count = Article::all()->count();
      $view_count = Article::all()->sum('hit');
      $website_status = Config::find(1);
      $contact_contact = Contact::all()->count();
      return view('back.dashboard', compact([
        'article_count',
        'view_count',
        'website_status',
        'contact_contact'
      ]));
    }
    
}
