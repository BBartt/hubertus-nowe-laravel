<?php

namespace App\Http\Controllers;

use App\Models\TrophyGallery;
use Illuminate\Http\Request;
use File;

class TrophyGalleryController extends Controller{
  public function __construct(){
    $this->middleware('auth')->except(['show']);
  }

  public function create(){
      return view('trophyGallery.create');
  }

  public function store(Request $request){

      $request->validate([
        'name' => 'required',
        'thumbnail' => 'required|file|mimes:jpeg,png,gif,jpg'
      ]);

      $fileName = rand()."___".$request->file('thumbnail')->getClientOriginalName();

      $request->file('thumbnail')->storeAs('/public/trofea_galeria/thumbnails', $fileName);
      TrophyGallery::create(['name' => $request->name, 'thumbnail' => $fileName]);
      return redirect()->route('trofea.index')->with('success', 'Miniaturka i nazwa galerii dodana pomyślnie.');
  }

  public function show($id){
    $gallery = TrophyGallery::find($id);
    return view('trophyGallery.show', compact('gallery'));
  }

  public function edit(TrophyGallery $trofea_galerium){
    return view('trophyGallery.edit', compact('trofea_galerium'));
  }

  public function update(Request $request, TrophyGallery $trofea_galerium){

    $request->validate([
      'name' => 'required',
    ]);

    $trofea_galerium->name = $request->name;

    if($request->hasFile('thumbnail')){
      $galleryThumbnail = $trofea_galerium->thumbnail;

      if(File::exists(public_path().'/storage/trofea_galeria/thumbnails/'.$galleryThumbnail)) {
        File::delete(public_path().'/storage/trofea_galeria/thumbnails/'.$galleryThumbnail);
      }

      $fileName = rand()."___".$request->file('thumbnail')->getClientOriginalName();
      $trofea_galerium->thumbnail = $fileName;

      $request->file('thumbnail')->storeAs('/public/trofea_galeria/thumbnails', $fileName);
    }else {
      $trofea_galerium->thumbnail = $request->thumbnail;
    }

    $trofea_galerium->save();

    return redirect()->route('trofea.index')->with('success', 'Miniaturka i/lub nazwa galerii zaktualizowana/ne pomyślnie.');
  }

  public function destroy($id){
      $gallery = TrophyGallery::findOrFail($id);

      if(
        File::isDirectory(public_path().'/storage/trofea_galeria/thumbnails')
          &&
        File::exists(public_path().'/storage/trofea_galeria/thumbnails/'.$gallery->thumbnail)
      ) {
        File::deleteDirectory(public_path().'/storage/trofea_galeria/gallery__images-'.$gallery->id);
        File::delete(public_path().'/storage/trofea_galeria/thumbnails/'.$gallery->thumbnail);
      }

      $gallery->images()->delete();
      $gallery->delete();

      return redirect()->route('trofea.index')->with('success', 'Galeria usunięte pomyślnie.');

  }
}
