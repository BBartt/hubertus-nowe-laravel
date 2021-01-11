<?php

namespace App\Http\Controllers;

use App\Models\Main;
use Illuminate\Http\Request;
use File;

class MainPageController extends Controller
{
  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function create(){
    return view('main.create');
  }

  public function store(Request $request){
    $request->validate([
      'image' => 'required',
      'description' => 'required'
    ]);

    if($request->hasFile('image')){
      $fileName = rand()."___".$request->file('image')->getClientOriginalName();
      $request->file('image')->storeAs('/public/main_page', $fileName);
    }

    Main::create([
      'image' => $fileName,
      'description' => $request->description,
    ]);

    return redirect()->route('home')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(Main $main){
    return view('main.edit', compact('main'));
  }

  public function update(Request $request, Main $main){

    $request->validate([
      'description' => 'required'
    ]);

    $main->description = $request->description;

    if($request->hasFile('image')){
      $image = $main->image;

      if(File::exists(public_path().'/storage/main_page/'.$image)) {
        File::delete(public_path().'/storage/main_page/'.$image);
      }

      $fileName = rand()."___".$request->file('image')->getClientOriginalName();
      $main->image = $fileName;

      $request->file('image')->storeAs('/public/main_page', $fileName);
    }

    $main->save();

    return redirect()->route('home')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(Main $main){
    $image = $main->image;

    if(File::exists(public_path().'/storage/main_page/'.$image)) {
      File::delete(public_path().'/storage/main_page/'.$image);
    }

    $main->delete();

    return redirect()->route('home')->with('success', 'Dane usuniętę pomyślnie.');

  }
}
