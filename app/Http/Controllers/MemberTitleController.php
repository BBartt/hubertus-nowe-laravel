<?php

namespace App\Http\Controllers;

use App\Models\MemberTitle;
use Illuminate\Http\Request;

class MemberTitleController extends Controller
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
        // $titles = MemberTitle::all();
        // return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membersTitles.create');
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
        'title1' => '',
        'title2' => ''
      ]);

      MemberTitle::create($request->all());
      return redirect()->route('czlonkowie_kola.index')->with('success', 'Tytuły sekcji dodane pomyślnie.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberTitle  $memberTitle
     * @return \Illuminate\Http\Response
     */
    public function show(MemberTitle $memberTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberTitle  $memberTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberTitle $membersTitle, Request $request)
    {
      // dd($request->title1);
      // dd($membersTitle);
      return view('membersTitles.edit', compact('membersTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberTitle  $memberTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($memberTitle);
        // dd($request->title1);

        $request->validate([
          'title1' => 'required',
          'title1' => 'required',
        ]);

        $memberTitle = MemberTitle::findOrFail(1);
        $memberTitle->title1 = $request->title1;
        $memberTitle->title2 = $request->title2;
        $memberTitle->save();

        return redirect()->route('czlonkowie_kola.index')->with('success', 'Tytuły sekcji zaktualizowane pomyślnie.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberTitle  $memberTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberTitle $memberTitle)
    {
        $memberTitle->delete();
        return redirect()->route('czlonkowie_kola.index')->with('success', 'Tytuły sekcji usunięty pomyślnie.');
    }
}
