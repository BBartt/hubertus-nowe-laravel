<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecorationsImages;
use File;

class DecorationsImagesController extends Controller{

  public function create($decoration_id){
    return view('decorationsImages.create', compact('decoration_id'));
  }

  public function store(Request $request){
    $this->validate($request, [
      'images' => 'required',
    ]);

    if($request->hasfile('images')){
      foreach($request->file('images') as $key=>$file){
        $filenameWithExt = $file->getClientOriginalName();
        $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

        DecorationsImages::create([
          'image' => $fileNameToSave,
          'decoration_id' => (int)$request->decoration_id,
        ]);
        $file->storeAs('/public/decorations/decorations__images-'.$request->decoration_id, $fileNameToSave);
      }
    }
    return redirect()->route('odznaczenia.index')->with('success', 'Zdjęcia dodane pomyślnie.');
  }

  public function edit($id){
    $image = DecorationsImages::find($id);
    return view('decorationsImages.edit', compact('image'));
  }

  public function update(Request $request,  $id){

    $request->validate(['image' => 'required']);

    $image = DecorationsImages::findOrFail($id);

    if($request->hasFile('image')){
      $fileName = $request->file('image')->getClientOriginalName();
      $decoration_id = $image->decoration_id;
      $dbImageName = $image->image;
      $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

      $image->image = $originalImageNameFromDatabase[0].$fileName;

      if( File::exists(public_path().'/storage/decorations/decorations__images-'.$decoration_id."/".$dbImageName) ) {
        File::delete( public_path().'/storage/decorations/decorations__images-'.$decoration_id."/".$dbImageName );
      }

      $request->file('image')->storeAs('/public/decorations/decorations__images-'.$decoration_id, $originalImageNameFromDatabase[0].$fileName);
    }else {
      $image->image = $request->image;
    }

    $image->save();

    return redirect()->route('odznaczenia.index')->with('success', 'Zdjęcia zaktualizowane pomyślnie.');
  }

  public function destroy($id){
    $image = DecorationsImages::findOrFail($id);

    if( File::exists( public_path().'/storage/decorations/decorations__images-'.$image->decoration_id.'\\'.$image->image )  ) {
      File::delete(public_path().'/storage/decorations/decorations__images-'.$image->decoration_id.'\\'.$image->image);
    }

    $image->delete();
    return redirect()->route('odznaczenia.index')->with('success', 'Zdjęcia zaktualizowane pomyślnie.');
  }

}
