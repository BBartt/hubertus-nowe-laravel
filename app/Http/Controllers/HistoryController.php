<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use File;

class HistoryController extends Controller{

  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index(){
    $histories = History::all();
    return view('history.index', compact('histories'));
  }

  public function create(){
    return view('history.create');
  }

  public function store(Request $request){

    $request->validate(['description' => 'required']);

    History::create($request->all());

    return redirect()->route('historia.index')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(History $historium){
    return view('history.edit', compact('historium'));
  }

  public function update(Request $request, History $historium){

    $request->validate([
      'description' => 'required'
    ]);

    $historium->description = $request->description;
    $historium->link1 = $request->link1;
    $historium->link2 = $request->link2;
    $historium->link3 = $request->link3;
    $historium->linkName1 = $request->linkName1;
    $historium->linkName2 = $request->linkName2;
    $historium->linkName3 = $request->linkName3;

    $historium->save();

    return redirect()->route('historia.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(History $historium){

    if(File::exists(public_path().'/storage/history__images-'.$historium->id)) {
      File::deleteDirectory(public_path().'/storage/history__images-'.$historium->id);
    }

    $historium->historyImages()->delete();

    $historium->delete();

    return redirect()->route('historia.index')->with('success', 'Dane usuniętę pomyślnie.');

  }
}
