<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residents;

class ResidentsController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    public function create(){
        return view('residents.create');
    }

    public function store(Request $request){
      $request->validate(['name' => 'required']);

      Residents::create($request->all());
      return redirect()->route('czlonkowie_kola.index')->with('success', 'Rezydent dodany pomyślnie.');
    }


    public function edit(Residents $rezydenci){
      // dd('asdas');
      return view('residents.edit', compact('rezydenci'));
    }

    public function update(Request $request, Residents $rezydenci){
      $request->validate([
        'name' => 'required',
      ]);

      $rezydenci->name = $request->name;
      $rezydenci->save();

      return redirect()->route('czlonkowie_kola.index')->with('success', 'Dane rezydenta zaktualizowane pomyślnie.');
    }

    public function destroy(Residents $rezydenci){
      $rezydenci->delete();
      return redirect()->route('czlonkowie_kola.index')->with('success', 'Dane rezydenta usunięte pomyślnie.');
    }
}
