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

    $imgs = [];

    for ($i=1; $i <= 5; $i++) {
      if($request->hasfile('img'.$i)){
        $imgs[$i] = rand()."__".$request->file("img".$i)->getClientOriginalName();
        $request->file("img$i")->storeAs('/public/decorations__images/', $imgs[$i]);
      }else {
        $imgs[$i] = null;
      }
    }

    Decoration::create([
      'title1' => $request->title1,
      'title2' => $request->title2,
      'not_trim_description' => $request->not_trim_description,
      'img1' => $imgs[1],
      'img2' => $imgs[2],
      'img3' => $imgs[3],
      'img4' => $imgs[4],
      'img5' => $imgs[5]
    ]);

    return redirect()->route('odznaczenia.index')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(Decoration $odznaczenium){
    return view('decorations.edit', compact('odznaczenium'));
  }

  public function update(Request $request, Decoration $odznaczenium){

    $request->validate(['not_trim_description' => 'required']);


    $imgs = [];

    for ($i=1; $i <= 5; $i++) {
      if($request->hasfile("img".$i)){
        $imgs[$i] = rand()."__".$request->file("img".$i)->getClientOriginalName();
        $request->file("img$i")->storeAs('/public/decorations__images', $imgs[$i]);
      }else {
        $imgs[$i] = $odznaczenium->{"img$i"};
      }
    }

    $odznaczenium->title1 = $request->title1;
    $odznaczenium->title2 = $request->title2;
    $odznaczenium->not_trim_description = $request->not_trim_description;
    $odznaczenium->img1 = $imgs[1];
    $odznaczenium->img2 = $imgs[2];
    $odznaczenium->img3 = $imgs[3];
    $odznaczenium->img4 = $imgs[4];
    $odznaczenium->img5 = $imgs[5];

    $odznaczenium->save();
    return redirect()->route('odznaczenia.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(Decoration $odznaczenium){

    for ($i=1; $i <= 5; $i++) {
      $img = $odznaczenium->{"img$i"} ?: "lorem ipsum";
      if(  File::exists( public_path().'/storage/decorations__images/'.$img )  ) {
        File::delete(public_path().'/storage/decorations__images/'.$img);
      }
    }

    $odznaczenium->delete();

    return redirect()->route('odznaczenia.index')->with('success', 'Dane usunięte pomyślnie.');
  }
}
