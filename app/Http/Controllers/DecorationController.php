<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decoration;
use File;

class DecorationController extends Controller{

  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index(){
    $decorations = Decoration::all();
    return view('decorations.index', compact('decorations'));
  }

  public function create(){
    return view('decorations.create');
  }

  public function store(Request $request){

    $request->validate([ 'title1' => 'required', 'not_trim_description' => 'required']);

    Decoration::create([
      'title1' => $request->title1,
      'title2' => $request->title2,
      'not_trim_description' => $request->not_trim_description
    ]);

    return redirect()->route('odznaczenia.index')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(Decoration $odznaczenium){
    return view('decorations.edit', compact('odznaczenium'));
  }

  public function update(Request $request, Decoration $odznaczenium){

    $request->validate(['not_trim_description' => 'required']);

    $odznaczenium->title1 = $request->title1;
    $odznaczenium->title2 = $request->title2;
    $odznaczenium->not_trim_description = $request->not_trim_description;

    $odznaczenium->save();
    return redirect()->route('odznaczenia.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(Decoration $odznaczenium){

    if(
      File::isDirectory(public_path().'/storage/decorations')
        &&
      File::exists(public_path().'/storage/decorations/decorations__images-'.$odznaczenium->id)
    ) {
      File::deleteDirectory(public_path().'/storage/decorations/decorations__images-'.$odznaczenium->id);
    }

    $odznaczenium->images()->delete();
    $odznaczenium->delete();

    return redirect()->route('odznaczenia.index')->with('success', 'Dane usunięte pomyślnie.');
  }

}
