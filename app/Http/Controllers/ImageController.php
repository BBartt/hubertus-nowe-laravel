<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use File;


class ImageController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gallery_id)
    {
      return view('images.create')->with('gallery_id', $gallery_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request, [
        'images' => 'required',
      ]);

      if($request->hasfile('images')){
        foreach($request->file('images') as $key=>$file){
          $filenameWithExt = $file->getClientOriginalName();
          $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

          Image::create([
            'image' => $fileNameToSave,
            'gallery_id' => (int)$request->gallery_id,
            'description' => $request->description
          ]);
          $file->storeAs('/public/galleries/gallery__images-'.$request->gallery_id, $fileNameToSave);

        }
      }

      return redirect('/galerie/'.$request->input('gallery_id'))->with('success', 'Zdjęcia zostały dodane');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);
        return view('images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
      $request->validate([
        'image' => 'required',
      ]);

      $image = Image::findOrFail($id);

      $image->description = $request->description;

      if($request->hasFile('image')){
        $fileName = $request->file('image')->getClientOriginalName();
        $gallery_id = $image->gallery_id;
        $dbImageName = $image->image;
        $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

        $image->image = $originalImageNameFromDatabase[0].$fileName;

        if( File::exists(public_path().'/storage/galleries/gallery__images-'.$gallery_id."/".$dbImageName) ) {
          File::delete( public_path().'/storage/galleries/gallery__images-'.$gallery_id."/".$dbImageName );
        }

        $request->file('image')->storeAs('/public/galleries/gallery__images-'.$gallery_id, $originalImageNameFromDatabase[0].$fileName);
      }else {
        $image->image = $request->image;
      }

      $image->save();

      return redirect('galerie/'.$image->gallery_id)->with('success', 'Zdjęcie w galerii zaktualizowane pomyślnie.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $image = Image::findOrFail($id);

      if(File::isDirectory(public_path().'/storage/galleries/gallery__images-'.$image->gallery_id)) {
        File::delete(public_path().'/storage/galleries/gallery__images-'.$image->gallery_id.'\\'.$image->image);
      }

      $image->delete();
      return redirect('galerie/'.$image->gallery_id)->with('success', 'Zdjęcie w galerii usunięte pomyślnie.');
    }
}
