<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use File;

class NewsController extends Controller{
  public function __construct(){
    $this->middleware('auth')->except(['index', 'show']);
  }

  public function index(){
      $news = News::all();
      return view('news.index', compact('news'));
  }

  public function create(){
    return view('news.create');
  }

  public function store(Request $request){

      $request->validate([
        'description' => 'required',
        'image' => 'required|file|mimes:jpeg,png,gif,jpg'
      ]);

      $fileName = rand()."___".$request->file('image')->getClientOriginalName();

      $request->file('image')->storeAs('/public/news', $fileName);
      News::create(['description' => $request->description, 'image' => $fileName]);
      return redirect()->route('aktualnosci.index')->with('success', 'aktualność dodana pomyślnie.');
  }

  public function edit(News $aktualnosci){
    return view('news.edit', compact('aktualnosci'));
  }

  public function update(Request $request, News $aktualnosci){

    $request->validate([
      'description' => 'required',
    ]);

    $aktualnosci->description = $request->description;

    if($request->hasFile('image')){
      $image = $aktualnosci->image;

      if(File::exists(public_path().'/storage/news/'.$image)) {
        File::delete(public_path().'/storage/news/'.$image);
      }

      $fileName = rand()."___".$request->file('image')->getClientOriginalName();
      $aktualnosci->image = $fileName;

      $request->file('image')->storeAs('/public/news', $fileName);
    }

    $aktualnosci->save();

    return redirect()->route('aktualnosci.index')->with('success', 'aktualność zaktualizowana pomyślnie.');
  }

  public function destroy($id)
  {
      $news = News::findOrFail($id);

      if(File::exists(public_path().'/storage/news/'.$news->image)) {
        File::delete(public_path().'/storage/news/'.$news->image);
      }

      $news->delete();

      return redirect()->route('aktualnosci.index')->with('success', 'Aktualność usunięta pomyślnie.');

  }
}
