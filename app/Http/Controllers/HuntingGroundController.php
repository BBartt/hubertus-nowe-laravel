<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HuntingGround;
use File;

class HuntingGroundController extends Controller{

  public function __construct(){
    $this->middleware('auth')->except(['index']);
  }

  public function index(){
      $images = HuntingGround::all();
      return view('hunting_ground.index', compact('images'));
  }

  public function create(){
      return view('hunting_ground.create');
  }

  public function store(Request $request){

    if($request->hasfile('images')){
      foreach($request->file('images') as $key=>$file){
        $filenameWithExt = $file->getClientOriginalName();
        $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

        HuntingGround::create(['image' => $fileNameToSave]);
        $file->storeAs('/public/hunting_ground/', $fileNameToSave);
      }
    }

    return redirect()->route('lowiska.index')->with('success', 'Zdjęcia zostały dodane.');

  }

  public function edit($id){
      $image = HuntingGround::find($id);
      return view('hunting_ground.edit', compact('image'));
  }

  public function update(Request $request,  $id){
    $request->validate(['image' => 'required']);

    $image = HuntingGround::findOrFail($id);

    if($request->hasFile('image')){
      $fileName = $request->file('image')->getClientOriginalName();
      $dbImageName = $image->image;
      $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

      $image->image = $originalImageNameFromDatabase[0].$fileName;

      if( File::exists(public_path().'/storage/hunting_ground/'.$dbImageName) ) {
        File::delete( public_path().'/storage/hunting_ground/'.$dbImageName );
      }

      $request->file('image')->storeAs('/public/hunting_ground/', $originalImageNameFromDatabase[0].$fileName);
    }

    $image->save();

    return redirect()->route('lowiska.index')->with('success', 'Zdjęcie zaktualizowane pomyślnie.');

  }

  public function destroy($id){
    $image = HuntingGround::findOrFail($id);

    if( File::exists(public_path().'/storage/hunting_ground/'.$image->image) ) {
      File::delete( public_path().'/storage/hunting_ground/'.$image->image );
    }

    $image->delete();
    return redirect()->route('lowiska.index')->with('success', 'Zdjęcia usunięte pomyślnie.');
  }
}
