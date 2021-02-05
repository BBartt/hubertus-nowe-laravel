<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decoration;
use App\Models\DecorationsTitlesAndImages;


class DecorationController extends Controller
{

  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index(){
    $decorations = Decoration::all();
    $data = DecorationsTitlesAndImages::find(1);
    return view('decorations.index', compact('decorations', 'data'));
  }

  public function create(){
    return view('decorations.create');
  }

  public function store(Request $request){
    $request->validate(['not_trim_description' => 'required']);
    Decoration::create($request->all());
    return redirect()->route('odznaczenia.index')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(Decoration $odznaczenium){
    return view('decorations.edit', compact('odznaczenium'));
  }

  public function update(Request $request, Decoration $odznaczenium){
    $request->validate(['not_trim_description' => 'required']);
    $odznaczenium->not_trim_description = $request->not_trim_description;
    $odznaczenium->save();
    return redirect()->route('odznaczenia.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(Decoration $odznaczenium){
    $odznaczenium->delete();
    return redirect()->route('odznaczenia.index')->with('success', 'Dane usunięte pomyślnie.');
  }
}
