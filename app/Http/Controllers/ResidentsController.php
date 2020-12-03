<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residents;

class ResidentsController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('residents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate(['name' => 'required']);

      Residents::create($request->all());
      return redirect()->route('czlonkowie_kola.index')->with('success', 'Rezydent dodany pomyślnie.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Residents $rezydenci)
    {
      // dd('asdas');
      return view('residents.edit', compact('rezydenci'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Residents $rezydenci)
    {
      $request->validate([
        'name' => 'required',
      ]);

      $rezydenci->name = $request->name;
      $rezydenci->save();

      return redirect()->route('czlonkowie_kola.index')->with('success', 'Dane rezydenta zaktualizowane pomyślnie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Residents $rezydenci)
    {
      $rezydenci->delete();
      return redirect()->route('czlonkowie_kola.index')->with('success', 'Dane rezydenta usunięte pomyślnie.');
    }
}
