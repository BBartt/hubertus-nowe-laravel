<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Residents;
use App\Models\MemberTitle;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $members = Member::all();
      $titles = MemberTitle::find(1);
      $residents = Residents::all();
      return view('members.index', compact('members', 'titles', 'residents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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

      Member::create($request->all());
      return redirect()->route('czlonkowie_kola.index')->with('success', 'Członek koła dodany pomyślnie.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    // public function show(Member $member)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $czlonkowie_kola, Request $request)
    {

      // dd($czlonkowie_kola);
      // dd($request);
      return view('members.edit', compact('czlonkowie_kola'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $czlonkowie_kola)
    {
      $request->validate([
        'name' => 'required',
      ]);

      $czlonkowie_kola->name = $request->name;
      $czlonkowie_kola->save();

      return redirect()->route('czlonkowie_kola.index')->with('success', 'Dane członka koła zaktualizowane pomyślnie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $czlonkowie_kola)
    {
        $czlonkowie_kola->delete();
        return redirect()->route('czlonkowie_kola.index')->with('success', 'Członek koła usunięty pomyślnie.');
    }
}
