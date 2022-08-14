<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HuntersGalleryImage;
use File;

class HuntersGalleryImageController extends Controller
{

      public function create($gallery_id){
        return view('huntersGalleryImages.create')->with('gallery_id', $gallery_id);
      }

      public function store(Request $request){

        $this->validate($request, [
          'images' => 'required',
        ]);

        if($request->hasfile('images')){
          foreach($request->file('images') as $key=>$file){
            $filenameWithExt = $file->getClientOriginalName();
            $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

            HuntersGalleryImage::create([
              'image' => $fileNameToSave,
              'hunters_gallery_id' => (int)$request->gallery_id
            ]);
            $file->storeAs('/public/hunters-galleries/gallery__images-'.$request->gallery_id, $fileNameToSave);

          }
        }

        return redirect()->route('galerie-mysliwego.show', $request->gallery_id)->with('success', 'Zdjęcia zostały dodane.');

      }

      public function edit($id){
          $image = HuntersGalleryImage::find($id);
          return view('HuntersGalleryImages.edit', compact('image'));
      }

      public function update(Request $request,  $id){

        $request->validate([
          'image' => 'required',
        ]);

        $image = HuntersGalleryImage::findOrFail($id);

        $image->description = $request->description;

        if($request->hasFile('image')){
          $fileName = $request->file('image')->getClientOriginalName();
          $gallery_id = $image->hunters_gallery_id;
          $dbImageName = $image->image;
          $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

          $image->image = $originalImageNameFromDatabase[0].$fileName;

          if( File::exists(public_path().'/storage/hunters-galleries/gallery__images-'.$gallery_id."/".$dbImageName) ) {
            File::delete( public_path().'/storage/hunters-galleries/gallery__images-'.$gallery_id."/".$dbImageName );
          }

          $request->file('image')->storeAs('/public/hunters-galleries/gallery__images-'.$gallery_id, $originalImageNameFromDatabase[0].$fileName);
        }else {
          $image->image = $request->image;
        }

        $image->save();

        return redirect()->route('galerie-mysliwego.show', $image->hunters_gallery_id)->with('success', 'Zdjęcie w galerii zaktualizowane pomyślnie.');


      }

      public function destroy($id){
        $image = HuntersGalleryImage::findOrFail($id);

        if(File::isDirectory(public_path().'/storage/hunters-galleries/gallery__images-'.$image->hunters_gallery_id)) {
          File::delete(public_path().'/storage/hunters-galleries/gallery__images-'.$image->hunters_gallery_id.'\\'.$image->image);
        }

        $image->delete();
        return redirect()->route('galerie-mysliwego.show', $image->hunters_gallery_id)->with('success', 'Zdjęcie w galerii usunięte pomyślnie.');

      }

}
