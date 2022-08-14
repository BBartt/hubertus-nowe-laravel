<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefugeImage;
use File;


class RefugeImagesController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function create($refuge_id){
    return view('refuge_images.create', compact('refuge_id'));
  }

  public function store(Request $request){

    $this->validate($request, [
      'images' => 'required',
      'refuge_id' => 'required',
    ]);

    if($request->hasfile('images')){
      foreach($request->file('images') as $key=>$file){
        $filenameWithExt = $file->getClientOriginalName();
        $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

        RefugeImage::create([
          'image' => $fileNameToSave,
          'refuge_id' => (int)$request->refuge_id,
        ]);

        $file->storeAs('/public/refuges__images-'.$request->refuge_id, $fileNameToSave);

      }
    }

    return redirect()->route('ostoja.index')->with('success', 'Zdjęcia dodane pomyślnie.');

  }

  public function edit($id){
    $image = RefugeImage::find($id);
    return view('refuge_images.edit', compact('image'));
  }

  public function update(Request $request, $id){
    // dd($id);
    // dd($request);
    // dd('aaaa');

    $request->validate([
      'image' => 'required',
      'refuge_id' => 'required',
    ]);

    // dd($request);

    $image = RefugeImage::findOrFail($id);

    if($request->hasFile('image')){
      $fileName = $request->file('image')->getClientOriginalName();

      $refuge_id = $image->refuge_id;
      $dbImageName = $image->image;
      $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

      $image->image = $originalImageNameFromDatabase[0].$fileName;

      if( File::exists(public_path().'/storage/refuges__images-'.$refuge_id."/".$dbImageName) ) {
        File::delete( public_path().'/storage/refuges__images-'.$refuge_id."/".$dbImageName );
      }

      $request->file('image')->storeAs('/public/refuges__images-'.$refuge_id, $originalImageNameFromDatabase[0].$fileName);
    }

    $image->save();

    return redirect()->route('ostoja.index')->with('success', 'Zdjęcie zaktualizowane pomyślnie.');
  }

  public function destroy($id){
    $image = RefugeImage::findOrFail($id);

    if(File::isDirectory(public_path().'/storage/refuges__images-'.$image->refuge_id)) {
      File::delete(public_path().'/storage/refuges__images-'.$image->refuge_id.'\\'.$image->image);
    }

    $image->delete();
    return redirect()->route('ostoja.index')->with('success', 'Zdjęcie usunięte pomyślnie.');
  }
}
