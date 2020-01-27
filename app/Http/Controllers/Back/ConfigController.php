<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Models
use App\Models\ConfigModels;

class ConfigController extends Controller
{
    public function index(){
      $config = ConfigModels::find(1);
      return view('back.config.index', compact('config'));
    }
    
    public function update(Request $request){
      $config = ConfigModels::find(1);
      $config->title = $request->title;
      $config->status = $request->status;
      $config->fb = $request->fb;
      $config->ig = $request->ig;
      $config->tw = $request->tw;
      $config->gh = $request->gh;
      $config->li = $request->li;
      $config->yt = $request->yt;
      
      if ($request->hasFile('logo')) {
        $logo_name = str_slug($config->title).'-logo-'.'.'.$request->logo->getClientOriginalExtension();
        $request->logo->move(public_path('admin/uploads'), $logo_name);
        $config->logo = 'uploads/'.$logo_name;
      }
      
      if ($request->hasFile('favicon')) {
        $favicon_name = str_slug($config->title).'-favicon-'.'.'.$request->favicon->getClientOriginalExtension();
        $request->favicon->move(public_path('admin/uploads'), $favicon_name);
        $config->favicon = 'uploads/'.$favicon_name;
      }
      
      $config->save();
      toastr()->success('Confiurations has been updated successfully !');
      return redirect()->back();
    }
}








