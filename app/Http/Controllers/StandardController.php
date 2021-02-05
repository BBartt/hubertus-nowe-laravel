<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Standard;
use Illuminate\Support\Facades\File;


class StandardController extends Controller
{

  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index(){
     $standards = Standard::all();
     return view('standard.index', compact('standards'));
  }

  public function create(){
   return view('standard.create');
  }

  public function store(Request $request){
   $request->validate([
     'image' => 'required|file|image|mimes:jpeg,png,gif,jpg'
   ]);

   $request->file('image')->storeAs('/public/standard-img', $request->file('image')->getClientOriginalName());
   Standard::create(['title' => $request->title, 'image' => $request->image->getClientOriginalName()]);
   return redirect()->route('sztandar.index')->with('success', 'Dane dodane pomyślnie.');

  }

  public function edit(Standard $sztandar){
   return view('standard.edit', compact('sztandar'));
  }

  public function update(Request $request, Standard $sztandar){
   $request->validate([
     'image' => 'file|image|mimes:jpeg,png,gif,jpg'
   ]);

   $sztandar = Standard::findOrFail($sztandar->id);
   $sztandar->title = $request->title;

   if($request->hasFile('image')){
     $fileName = $request->file('image')->getClientOriginalName();

     $sztandar->image = $fileName;

     if(File::exists(public_path().'/storage/standard-img/'.$sztandar->image)) {
       File::delete(public_path().'/storage/standard-img/'.$sztandar->image);
     }

     $request->file('image')->storeAs('/public/standard-img', $request->file('image')->getClientOriginalName());
   }

   $sztandar->save();
   return redirect()->route('sztandar.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(Standard $sztandar){
   if(File::exists(public_path().'/storage/standard-img/'.$sztandar->image)) {
     File::delete(public_path().'/storage/standard-img/'.$sztandar->image);
   }
   $sztandar->delete();
   return redirect()->route('sztandar.index')->with('success', 'Dane usunięte pomyślnie.');
  }


}
