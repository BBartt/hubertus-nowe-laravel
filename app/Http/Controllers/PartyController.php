<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use File;

class PartyController extends Controller
{
  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index()
  {
      $parties = Party::all();
      return view('party.index', compact('parties'));
  }

  public function create(){
    return view('party.create');
  }

  public function store(Request $request){

    $request->validate([
      'description' => 'required'
    ]);

    Party::create($request->all());

    return redirect()->route('imprezy.index')->with('success', 'Dane dodane pomyślnie.');
  }

  public function edit(Party $imprezy){
    return view('party.edit', compact('imprezy'));
  }

  public function update(Request $request, Party $imprezy){

    $request->validate([
      'description' => 'required'
    ]);

    $imprezy->description = $request->description;
    $imprezy->link_1 = $request->link_1;
    $imprezy->link_2 = $request->link_2;
    $imprezy->link_3 = $request->link_3;
    $imprezy->link_4 = $request->link_4;
    $imprezy->link_5 = $request->link_5;

    $imprezy->save();

    return redirect()->route('imprezy.index')->with('success', 'Dane zaktualizowane pomyślnie.');
  }

  public function destroy($id){

    $image = Party::findOrFail($id);

    if(File::exists(public_path().'/storage/party__images-'.$image->id)) {
      File::deleteDirectory(public_path().'/storage/party__images-'.$image->id);
    }

    $image->partyImages()->delete();

    $image->delete();

    return redirect()->route('imprezy.index')->with('success', 'Dane usuniętę pomyślnie.');

  }

}
