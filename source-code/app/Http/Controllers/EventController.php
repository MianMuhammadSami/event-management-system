<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Type;
use \App\Models\Event;
use Illuminate\Support\Str;

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

        $events = Event::select('events.id', 'events.name', 'events.description', 'events.image', 'events.type_id', 'types.name AS event_type', 'events.hash_id')
            ->leftJoin('types', 'types.id', '=', 'events.type_id')->get();

        return view('events.index', compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('events.create', compact('types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $hash_event_id)
    {

        $event = Event::where(['hash_id' => $hash_event_id])->first();
        $types = Type::all();
        return view('events.edit', compact('event', 'types'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\CreateEventRequest $request)
    {
        $event = new Event;
        $event->hash_id = Str::random(30);
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
    public function destroy(string $hash_event_id)
    {

        $event = Event::where(['hash_id' => $hash_event_id])->first();

        if ($event) {
            $event->delete();
            session()->flash('destroy', "Event # $event->id deleted successfully.");
        } else {
            session()->flash('destroy', "Event # $hash_event_id Not Found.");
        }

        return redirect()->route('events');


    }
}
