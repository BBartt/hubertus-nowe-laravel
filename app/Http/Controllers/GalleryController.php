<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Image;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
// use Illuminate\Http\File;
use File;



class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
          'name' => 'required',
          'thumbnail' => 'required|file|mimes:jpeg,png,gif,jpg'
        ]);

        $request->file('thumbnail')->storeAs('/public/galleries/thumbnails', $request->file('thumbnail')->getClientOriginalName());
        Gallery::create(['name' => $request->name, 'thumbnail' => $request->thumbnail->getClientOriginalName()]);
        return redirect()->route('galerie.index')->with('success', 'Miniaturka i nazwa galerii dodana pomyślnie.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $gallery = Gallery::find($id);
      return view('gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $galerie)
    {
      return view('gallery.edit', compact('galerie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $galerie)
    {

      $request->validate([
        'name' => 'required',
        'thumbnail' => 'required|file|image|mimes:jpeg,png,gif,jpg'
      ]);

      $galerie->name = $request->name;

      if($request->hasFile('thumbnail')){
        $fileName = $request->file('thumbnail')->getClientOriginalName();
        $galleryThumbnail = $galerie->thumbnail;

        $galerie->thumbnail = $fileName;

        if(File::exists(public_path().'/storage/galleries/thumbnails/'.$galleryThumbnail)) {
          File::delete(public_path().'/storage/galleries/thumbnails/'.$galleryThumbnail);
        }

        $request->file('thumbnail')->storeAs('/public/galleries/thumbnails', $fileName);
      }else {
        $galerie->thumbnail = $request->thumbnail;
      }

      $galerie->save();

      return redirect()->route('galerie.index')->with('success', 'Miniaturka i/lub nazwa galerii zaktualizowana/ne pomyślnie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if(
          File::isDirectory(public_path().'/storage/galleries/thumbnails')
            &&
          File::exists(public_path().'/storage/galleries/thumbnails/'.$gallery->thumbnail)
        ) {
          File::deleteDirectory(public_path().'/storage/galleries/gallery__images-'.$gallery->id);
          File::delete(public_path().'/storage/galleries/thumbnails/'.$gallery->thumbnail);
        }

        $gallery->images()->delete();
        $gallery->delete();

        return redirect()->route('galerie.index')->with('success', 'Zdjęcie w galerii usunięte pomyślnie.');

    }
}
