<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::whereNull('deleted_at')->get();
        return response()->json($events);
    }

    public function cal()
    {
        $title = 'Calendar';

        $breadcrumbs = [
            ['label' => $title, 'url' => '', 'active' => true],
        ];

        // Fetch events that are not deleted
        $events = Event::whereNull('deleted_at')->get();
        $customer = Customer::all();

        // Format events in FullCalendar-compatible format
        $events = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
            ];
        });

        // Pass events to the view
        return view('calender.calendar', compact('title', 'breadcrumbs', 'events', 'customer'));
    }

    public function pastevents()
    {
        $title = 'Past events';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];

        $data = Event::where('start', '<', Carbon::now())->get();


        return view('pastEvent.index', compact('title', 'breadcrumbs', 'data'));
    }
    public function checkEventOnDate($date)
    {
        $event = Event::whereDate('start', $date)->first();
        return response()->json(['exists' => $event !== null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date_format:Y-m-d H:i:s', // Ensure correct format
            'end' => 'nullable|date_format:Y-m-d H:i:s', // Ensure correct format
            'customer' => 'required|string|max:255',
        ]);


        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end ?? $request->start, // Use start date as end date if end is not provided
            'customer_id' => $request->customer,
            'created_by' => auth()->id() ?? null, // Assuming you want to track who created the event
        ]);

        return response()->json($event, 201);
    }
    // Soft delete an event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Delete the event
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully.'], 200);
    }


    // Restore a soft-deleted event
    public function restore($id)
    {
        $event = Event::withTrashed()->find($id);

        if ($event && $event->trashed()) {
            $event->restore();
            return response()->json(['message' => 'Event restored successfully']);
        }

        return response()->json(['message' => 'Event not found or not deleted'], 404);
    }
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->title = $request->input('title');
        // $event->start = $request->input('start');
        // $event->end = $request->input('end');

        $event->save();

        return response()->json($event);
    }
}
