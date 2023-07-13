<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $hash_event_id)
    {
        return view('events.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\CreateEventRequest $request)
    {
        $event = new Event;
        $event->hash_id = sha1($request->name.$request->description.$request->type_id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->type_id = $request->type_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $event->image = $imageName;
        }

        $event->save();
        session()->flash('success', "Event created successfully, # $event->id");
        return redirect()->route('create');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
