<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrophyGalleryImages;
use File;

class TrophyGalleryImagesController extends Controller{

  public function create($trophy_gallery_id){
    return view('trophyGalleryImages.create')->with('trophy_gallery_id', $trophy_gallery_id);
  }

  public function store(Request $request){

    $this->validate($request, [
      'images' => 'required',
      'trophy_gallery_id' => 'required',
    ]);

    if($request->hasfile('images')){
      foreach($request->file('images') as $key=>$file){
        $filenameWithExt = $file->getClientOriginalName();
        $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

        TrophyGalleryImages::create([
          'image' => $fileNameToSave,
          'trophy_gallery_id' => (int)$request->trophy_gallery_id,
          'description' => $request->description
        ]);
        $file->storeAs('/public/trofea_galeria/gallery__images-'.$request->trophy_gallery_id, $fileNameToSave);
      }
    }

    return redirect('/trofea-galeria/'.$request->input('trophy_gallery_id'))->with('success', 'Zdjęcia zostały dodane');
  }

  public function edit($id){
      $image = TrophyGalleryImages::find($id);
      return view('trophyGalleryImages.edit', compact('image'));
  }

  public function update(Request $request,  $id){
    $request->validate([
      'image' => 'required',
    ]);

    $image = TrophyGalleryImages::findOrFail($id);

    $image->description = $request->description;

    if($request->hasFile('image')){
      $fileName = $request->file('image')->getClientOriginalName();
      $trophy_gallery_id = $image->trophy_gallery_id;
      $dbImageName = $image->image;
      $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

      $image->image = $originalImageNameFromDatabase[0].$fileName;

      if( File::exists(public_path().'/storage/trofea_galeria/gallery__images-'.$trophy_gallery_id."/".$dbImageName) ) {
        File::delete( public_path().'/storage/trofea_galeria/gallery__images-'.$trophy_gallery_id."/".$dbImageName );
      }

      $request->file('image')->storeAs('/public/trofea_galeria/gallery__images-'.$trophy_gallery_id, $originalImageNameFromDatabase[0].$fileName);
    }else {
      $image->image = $request->image;
    }

    $image->save();

    return redirect('trofea-galeria/'.$image->trophy_gallery_id)->with('success', 'Zdjęcie w galerii zaktualizowane pomyślnie.');

  }

  public function destroy($id){
    $image = TrophyGalleryImages::findOrFail($id);

    if(File::isDirectory(public_path().'/storage/trofea_galeria/gallery__images-'.$image->trophy_gallery_id)) {
      File::delete(public_path().'/storage/trofea_galeria/gallery__images-'.$image->trophy_gallery_id.'\\'.$image->image);
    }

    $image->delete();
    return redirect('trofea-galeria/'.$image->trophy_gallery_id)->with('success', 'Zdjęcie w galerii usunięte pomyślnie.');
  }
  
}
