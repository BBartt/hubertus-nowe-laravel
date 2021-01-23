<?php

namespace App\Http\Controllers;

use App\Models\Trophy;
use App\Models\TrophyGallery;
use Illuminate\Http\Request;

class TrophyController extends Controller
{
  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index(){
    $trophies = Trophy::all();
    $galleries = TrophyGallery::all();
    return view('trophy.index', compact('trophies', 'galleries'));
  }

  public function create(){
    return view('trophy.create');
  }

  public function store(Request $request){

    $request->validate([
      'not_trim_description' => 'required'
    ]);

    Trophy::create($request->all());
    return redirect()->route('trofea.index')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(Trophy $trofea){
    return view('trophy.edit', compact('trofea'));
  }

  public function update(Request $request, Trophy $trofea){

      $request->validate([
        'not_trim_description' => 'required',
      ]);

      $trofea->not_trim_description = $request->not_trim_description;
      $trofea->save();

      return redirect()->route('trofea.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(Trophy $trofea){
    $trofea->delete();
    return redirect()->route('trofea.index')->with('success', 'Dane usunięte pomyślnie.');
  }

}
