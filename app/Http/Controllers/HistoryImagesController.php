<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryImages;
use File;

class HistoryImagesController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }

  public function create($history_id){
    return view('historyImages.create', compact('history_id'));
  }

  public function store(Request $request){

    $this->validate($request, [
      'images' => 'required',
      'history_id' => 'required',
    ]);

    if($request->hasfile('images')){
      foreach($request->file('images') as $key=>$file){
        $filenameWithExt = $file->getClientOriginalName();
        $fileNameToSave = rand()."__key-".$key."___".$filenameWithExt;

        HistoryImages::create([
          'image' => $fileNameToSave,
          'history_id' => (int)$request->history_id,
        ]);

        $file->storeAs('/public/history__images-'.$request->history_id, $fileNameToSave);
      }
    }

    return redirect()->route('historia.index')->with('success', 'Zdjęcia dodane pomyślnie.');

  }

  public function edit($id){
    $image = HistoryImages::find($id);
    return view('historyImages.edit', compact('image'));
  }

  public function update(Request $request, $id){

    $request->validate([
      'image' => 'required',
      'history_id' => 'required',
    ]);

    $image = HistoryImages::findOrFail($id);

    if($request->hasFile('image')){
      $fileName = $request->file('image')->getClientOriginalName();

      $history_id = $image->history_id;
      $dbImageName = $image->image;
      $originalImageNameFromDatabase = str_split($dbImageName, strpos($dbImageName, "___")+3);

      $image->image = $originalImageNameFromDatabase[0].$fileName;

      if( File::exists(public_path().'/storage/history__images-'.$history_id."/".$dbImageName) ) {
        File::delete( public_path().'/storage/history__images-'.$history_id."/".$dbImageName );
      }

      $request->file('image')->storeAs('/public/history__images-'.$refuge_id, $originalImageNameFromDatabase[0].$fileName);
    }

    $image->save();

    return redirect()->route('historia.index')->with('success', 'Zdjęcie zaktualizowane pomyślnie.');
  }

  public function destroy($id){
    $image = HistoryImages::findOrFail($id);

    if(File::isDirectory(public_path().'/storage/history__images-'.$image->history_id)) {
      File::delete(public_path().'/storage/history__images-'.$image->history_id.'\\'.$image->image);
    }

    $image->delete();
    return redirect()->route('historia.index')->with('success', 'Zdjęcie usunięte pomyślnie.');
  }
}
