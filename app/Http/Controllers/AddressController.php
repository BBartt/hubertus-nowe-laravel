<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;


class AddressController extends Controller
{
    public function __construct(){
      $this->middleware('auth')->except('index');
    }

    public function index(){
      $address = Address::find(1);
      return view('address.index', compact('address'));
    }

    public function create(){
      return view('address.create');
    }

    public function store(Request $request){

      $request->validate([
        'address' => 'required'
      ]);

      Address::create($request->all());
      return redirect()->route('adres.index')->with('success', 'Adres sekcji dodane pomyślnie.');
    }

    public function edit(Address $adre, Request $request){
      return view('address.edit', compact('adre'));
    }

    public function update(Request $request, Address $adre){

        $request->validate([
          'address' => 'required',
        ]);

        $adre->address = $request->address;
        $adre->save();

        return redirect()->route('adres.index')->with('success', 'Adres zaktualizowany pomyślnie.');

    }

}
