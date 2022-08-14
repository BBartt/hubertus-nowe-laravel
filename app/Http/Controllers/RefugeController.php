<?php

namespace App\Http\Controllers;

use App\Models\Refuge;
use Illuminate\Http\Request;
use File;

class RefugeController extends Controller
{
  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index(){
      $refuges = Refuge::all();
      return view('refuge.index', compact('refuges'));
  }

  public function create(){
    return view('refuge.create');
  }

  public function store(Request $request){

    $request->validate([
      'description' => 'required'
    ]);

    Refuge::create($request->all());

    return redirect()->route('ostoja.index')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(Refuge $ostoja){
    // dd($ostoja);
    return view('refuge.edit', compact('ostoja'));
  }

  public function update(Request $request, Refuge $ostoja){

    // dd($ostoja);
    // dd($request);

    $request->validate([
      'description' => 'required'
    ]);

    $ostoja->description = $request->description;

    $ostoja->save();

    return redirect()->route('ostoja.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy(Refuge $ostoja){

    if(File::exists(public_path().'/storage/refuges__images-'.$ostoja->id)) {
      File::deleteDirectory(public_path().'/storage/refuges__images-'.$ostoja->id);
    }

    $ostoja->refugeImage()->delete();

    $ostoja->delete();

    return redirect()->route('ostoja.index')->with('success', 'Dane usuniętę pomyślnie.');

  }
}
