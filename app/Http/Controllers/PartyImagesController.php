<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartyImage;
use File;

class PartyImagesController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function create($party_id){
      return view('party_images.create', compact('party_id'));
    }

    public function store(Request $request){

        $this->validate($request, [
          'images' => 'required',
          'party_id' => 'required',
        ]);

        if($request->hasfile('images')){
          foreach($request->file('images') as $key=>$file){
            $filenameWithExt = $file->getClientOriginalName();
            $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

            PartyImage::create([
              'image' => $fileNameToSave,
              'party_id' => (int)$request->party_id,
            ]);

            $file->storeAs('/public/party__images-'.$request->party_id, $fileNameToSave);

          }
        }

        return redirect()->route('imprezy.index')->with('success', 'Zdjęcia dodane pomyślnie.');

    }

    public function edit($id){
      $image = PartyImage::find($id);
      return view('party_images.edit', compact('image'));
    }

    public function update(Request $request, $id){
      // dd($id);
      // dd($request);
      // dd('aaaa');

      $request->validate([
        'image' => 'required',
        'party_id' => 'required',
      ]);

      // dd($request);

      $image = PartyImage::findOrFail($id);

      if($request->hasFile('image')){
        $fileName = $request->file('image')->getClientOriginalName();

        $party_id = $image->party_id;
        $dbImageName = $image->image;
        $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

        $image->image = $originalImageNameFromDatabase[0].$fileName;

        if( File::exists(public_path().'/storage/party__images-'.$party_id."/".$dbImageName) ) {
          File::delete( public_path().'/storage/party__images-'.$party_id."/".$dbImageName );
        }

        $request->file('image')->storeAs('/public/party__images-'.$party_id, $originalImageNameFromDatabase[0].$fileName);
      }

      $image->save();

      return redirect()->route('imprezy.index')->with('success', 'Zdjęcia zaktualizowane pomyślnie.');
    }

    public function destroy($id){
      $image = PartyImage::findOrFail($id);

      if(File::isDirectory(public_path().'/storage/party__images-'.$image->party_id)) {
        File::delete(public_path().'/storage/party__images-'.$image->party_id.'\\'.$image->image);
      }

      $image->delete();
      return redirect()->route('imprezy.index')->with('success', 'Zdjęcia usunięte pomyślnie.');
    }
}
