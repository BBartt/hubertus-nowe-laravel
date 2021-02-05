<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecorationsTitlesAndImages;

class DecorationsTitlesAndImagesController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function create(){
      return view('decorationsTitlesAndImages.create');
    }

    public function store(Request $request){
      DecorationsTitlesAndImages::create([
        'id' => 1,
        'title1' => $request->title1,
        'title2' => $request->title2
      ]);
      return redirect()->route('odznaczenia.index')->with('success', 'Dane dodane pomyślnie.');
    }

    public function edit(DecorationsTitlesAndImages $id){
      // dd($id);
      return view('decorationsTitlesAndImages.edit', compact('id'));
    }

    public function update(Request $request, DecorationsTitlesAndImages $id){
      $id->title1 = $request->title1;
      $id->title2 = $request->title2;
      $id->save();
      return redirect()->route('odznaczenia.index')->with('success', 'Dane zaktualizowane pomyślnie.');
    }

    public function destroy(DecorationsTitlesAndImages $id){
      $id->delete();
      return redirect()->route('odznaczenia.index')->with('success', 'Dane usunięte pomyślnie.');
    }
}
