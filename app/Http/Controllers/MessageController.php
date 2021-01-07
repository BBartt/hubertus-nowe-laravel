<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use File;

class MessageController extends Controller
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
      $messages = Message::orderBy('created_at', 'desc')->get();
      return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('messages.create');
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
        'title' => 'required',
        'description' => 'required'
      ]);

      if($request->hasFile('image')){
        $fileName = rand()."___".$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('/public/messages', $fileName);
      }

      Message::create([
        'title' => $request->title,
        'description' => $request->description,
        'link' => $request->link,
        'linkName' => $request->linkName,
        'image' => isset($fileName) ? $fileName : null
      ]);

      return redirect()->route('komunikaty.index')->with('success', 'Komunikat dodany pomyślnie.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $komunikaty)
    {
      return view('messages.show', compact('komunikaty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $komunikaty)
    {
        // dd($komunikaty);
        return view('messages.edit', compact('komunikaty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $komunikaty)
    {
      $request->validate([
        'title' => 'required',
        'description' => 'required'
      ]);

      $komunikaty->title = $request->title;
      $komunikaty->description = $request->description;
      $komunikaty->link = $request->link;
      $komunikaty->linkName = $request->linkName;

      if($request->hasFile('image')){
        $fileName = rand()."___".$request->file('image')->getClientOriginalName();
        $komunikaty->image = $fileName;

        $image = $komunikaty->image;

        if(File::exists(public_path().'/storage/messages/'.$image)) {
          File::delete(public_path().'/storage/messages/'.$image);
        }

        $request->file('image')->storeAs('/public/messages', $fileName);
      }else {
        $komunikaty->image = $request->image;
      }

      $komunikaty->save();

      return redirect()->route('komunikaty.index')->with('success', 'Komunikat zaktualizowany pomyślnie.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $komunikaty)
    {
      $image = $komunikaty->image;
      if(File::exists(public_path().'/storage/messages/'.$image)) {
        File::delete(public_path().'/storage/messages/'.$image);
      }
      $komunikaty->delete();
      return redirect()->route('komunikaty.index')->with('success', 'Komunikat usunięty pomyślnie.');
    }
}
