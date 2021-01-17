<?php

namespace App\Http\Controllers;

use App\Models\Dead;
use Illuminate\Http\Request;

class DeadController extends Controller
{
  public function __construct(){
    $this->middleware('auth')->except('index');
  }

  public function index(){
    $deads = Dead::all();
    return view('dead.index', compact('deads'));
  }

  public function create(){
      return view('dead.create');
  }

  public function store(Request $request){
    $request->validate(['name' => 'required']);

    Dead::create($request->all());
    return redirect()->route('kraina.index')->with('success', 'Osoba dodany pomyślnie.');
  }

  public function edit(Dead $kraina){
    return view('dead.edit', compact('kraina'));
  }

  public function update(Request $request, Dead $kraina)
  {
    $request->validate([
      'name' => 'required',
    ]);

    $kraina->name = $request->name;
    $kraina->save();

    return redirect()->route('kraina.index')->with('success', 'Dane członka koła zaktualizowane pomyślnie.');
  }

  public function destroy(Dead $kraina)
  {
      $kraina->delete();
      return redirect()->route('kraina.index')->with('success', 'Osoba usunięta pomyślnie.');
  }
}
