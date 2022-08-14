<?php

namespace App\Http\Controllers;

use App\Models\OurDogs;
use Illuminate\Http\Request;
use File;

class OurDogsController extends Controller
{
    public function __construct(){
      $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $dogs = OurDogs::orderBy('created_at', 'desc')->get();
      return view('dogs.index', compact('dogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);

      $request->validate([
        'image' => 'required',
        'description' => 'required'
      ]);

      if($request->hasFile('image')){
        $fileName = rand()."___".$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('/public/our_dogs', $fileName);
      }

      // dd($fileName);

      OurDogs::create([
        'image' => $fileName,
        'description' => $request->description,
      ]);

      return redirect()->route('psy.index')->with('success', 'Pies dodany pomyślnie.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurDogs  $ourDogs
     * @return \Illuminate\Http\Response
     */
    // public function show(OurDogs $psy)
    // {
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurDogs  $ourDogs
     * @return \Illuminate\Http\Response
     */
    public function edit(OurDogs $psy)
    {
      // dd($psy);
      return view('dogs.edit', compact('psy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurDogs  $ourDogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurDogs $psy)
    {
      $request->validate([
        'description' => 'required'
      ]);

      $psy->description = $request->description;

      if($request->hasFile('image')){
        $image = $psy->image;

        if(File::exists(public_path().'/storage/our_dogs/'.$image)) {
          File::delete(public_path().'/storage/our_dogs/'.$image);
        }

        $fileName = rand()."___".$request->file('image')->getClientOriginalName();
        $psy->image = $fileName;

        $request->file('image')->storeAs('/public/our_dogs', $fileName);
      }

      $psy->save();

      return redirect()->route('psy.index')->with('success', 'Pies zaktualizowany pomyślnie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurDogs  $ourDogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurDogs $psy)
    {
      $image = $psy->image;

      if(File::exists(public_path().'/storage/our_dogs/'.$image)) {
        File::delete(public_path().'/storage/our_dogs/'.$image);
      }

      $psy->delete();

      return redirect()->route('psy.index')->with('success', 'Pies usunięty pomyślnie.');

    }
}
