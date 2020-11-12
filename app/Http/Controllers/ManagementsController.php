<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Management;
use Illuminate\Support\Facades\Storage;


class ManagementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware('auth')->only('create', 'destroy');
     }

    public function index()
    {
        $managements = Management::all();
        return view('managements.index', compact('managements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('managements.create');
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
        'image' => 'required|file|image|mimes:jpeg,png,gif,jpg|max:2048'
      ]);

      $request->file('image')->storeAs('/public/managements-img', $request->file('image')->getClientOriginalName());
      Management::create(['name' => $request->name, 'image' => $request->image->getClientOriginalName()]);
      return redirect()->route('zarzad.index')->with('success', 'Członek zarządu dodany pomyślnie.');

      if($request->file('image')){
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Management $zarzad)
    {
      // dd($zarzad);
      // $management = Management::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Management $zarzad)
    {
        $zarzad->delete();
        return redirect()->route('zarzad.index')->with('success', 'Członek zarządu usunięty pomyślnie.');
    }
}
