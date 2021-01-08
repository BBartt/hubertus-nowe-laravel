<?php

namespace App\Http\Controllers;

use App\Models\Venison;
use Illuminate\Http\Request;
use File;

class VenisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venisons = Venison::all();
        return view('venison.index', compact('venisons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venison.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required',
        'image' => 'required|file|mimes:jpeg,png,gif,jpg',
        'price' => 'required',
        'interval' => 'required'
      ]);

      $request->file('image')->storeAs('/public/venison', rand()."___".$request->file('image')->getClientOriginalName());
      Venison::create([
        'name' => $request->name,
        'image' => $request->image->getClientOriginalName(),
        'price' => $request->price, 'interval' => $request->interval
      ]);
      return redirect()->route('dziczyzna.index')->with('success', 'Nowy produkt dodany pomyślnie.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\venison  $venison
     * @return \Illuminate\Http\Response
     */
    public function show(Venison $dziczyzna)
    {
      // dd($dziczyzna);
      $venison = Venison::find($dziczyzna);
      return view('venison.show', compact('venison'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\venison  $venison
     * @return \Illuminate\Http\Response
     */
    public function edit(Venison $dziczyzna)
    {
      return view('venison.edit', compact('dziczyzna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\venison  $venison
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venison $dziczyzna)
    {
      $request->validate([
        'name' => 'required',
        'price' => 'required',
        'interval' => 'required'
      ]);

      $dziczyzna->name = $request->name;
      $dziczyzna->interval = $request->interval;
      $dziczyzna->price = $request->price;


      if($request->hasFile('image')){
        $image = $dziczyzna->image;

        if(File::exists(public_path().'/storage/venison/'.$image)) {
          File::delete(public_path().'/storage/venison/'.$image);
        }

        $fileName = rand()."___".$request->file('image')->getClientOriginalName();
        $dziczyzna->image = $fileName;

        $request->file('image')->storeAs('/public/venison', $fileName);
      } else {
        $dziczyzna->image = $request->image;
      }

      $dziczyzna->save();

      return redirect()->route('dziczyzna.index')->with('success', 'Dane produktu zaktualizowane pomyślnie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\venison  $venison
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venison $dziczyzna)
    {

      if(File::exists(public_path().'/storage/venison/'.$dziczyzna->image)) {
        File::delete(public_path().'/storage/venison/'.$dziczyzna->image);
      }

      $dziczyzna->delete();
      return redirect()->route('dziczyzna.index')->with('success', 'Produkt usunięty pomyślnie.');
    }
}
