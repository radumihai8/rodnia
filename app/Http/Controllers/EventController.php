<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin')->except(['index', 'show']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'date' => 'required|date',
        ]);


        Event::create($validated);

        return back()->with('success', 'Event Created!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'date' => 'required|date',
        ]);

        $event->update($validated);

        return back()->with('success', 'Event Updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Event $event){
        $event->delete();
        return back()->with('success', 'Event Deleted!');
    }
}
