<?php

namespace App\Http\Controllers;

use App\Models\HuntersGallery;
use Illuminate\Http\Request;
use File;

class HuntersGalleryController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
      $galleries = HuntersGallery::all();
      return view('huntersGallery.index', compact('galleries'));
  }

  public function create(){
      return view('huntersGallery.create');
  }

  public function store(Request $request){

      $request->validate([
        'name' => 'required',
        'thumbnail' => 'required|file|mimes:jpeg,png,gif,jpg'
      ]);

      $fileName = rand()."___".$request->file('thumbnail')->getClientOriginalName();

      $request->file('thumbnail')->storeAs('/public/hunters-galleries/thumbnails', $fileName);
      HuntersGallery::create(['name' => $request->name, 'thumbnail' => $fileName]);
      return redirect()->route('galerie-mysliwego.index')->with('success', 'Miniaturka i nazwa galerii dodana pomyślnie.');
  }

  public function show($id){
    $gallery = HuntersGallery::find($id);
    return view('huntersGallery.show', compact('gallery'));
  }

  public function edit(HuntersGallery $galerie_mysliwego){
    return view('huntersGallery.edit', compact('galerie_mysliwego'));
  }

  public function update(Request $request, HuntersGallery $galerie_mysliwego){

    $request->validate([
      'name' => 'required',
    ]);

    $galerie_mysliwego->name = $request->name;

    if($request->hasFile('thumbnail')){
      $galleryThumbnail = $galerie_mysliwego->thumbnail;

      if(File::exists(public_path().'/storage/hunters-galleries/thumbnails/'.$galleryThumbnail)) {
        File::delete(public_path().'/storage/hunters-galleries/thumbnails/'.$galleryThumbnail);
      }

      $fileName = rand()."___".$request->file('thumbnail')->getClientOriginalName();
      $galerie_mysliwego->thumbnail = $fileName;

      $request->file('thumbnail')->storeAs('/public/hunters-galleries/thumbnails', $fileName);
    }else {
      $galerie_mysliwego->thumbnail = $request->thumbnail;
    }

    $galerie_mysliwego->save();

    return redirect()->route('galerie-mysliwego.index')->with('success', 'Miniaturka i/lub nazwa galerii zaktualizowana/ne pomyślnie.');
  }

  public function destroy($id)
  {
      $gallery = HuntersGallery::findOrFail($id);

      if(
        File::isDirectory(public_path().'/storage/hunters-galleries/thumbnails')
          &&
        File::exists(public_path().'/storage/hunters-galleries/thumbnails/'.$gallery->thumbnail)
      ) {
        File::deleteDirectory(public_path().'/storage/hunters-galleries/gallery__images-'.$gallery->id);
        File::delete(public_path().'/storage/hunters-galleries/thumbnails/'.$gallery->thumbnail);
      }

      $gallery->images()->delete();
      $gallery->delete();

      return redirect()->route('galerie-mysliwego.index')->with('success', 'Galeria usunięte pomyślnie.');

  }
}
