<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Event;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $lec = Lecturer::all();

        // Format events in FullCalendar-compatible format
        $events = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
            ];
        });

        // Pass events to the view
        return view('calender.calendar', compact('title', 'breadcrumbs', 'events', 'customer', 'lec'));
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

    public function deletedevents()
    {
        $title = 'Deleted events';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];
        $data = Event::onlyTrashed()->get();

        return view('pastEvent.delete', compact('title', 'breadcrumbs', 'data'));
    }

    public function viewEvent(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'eventId' => 'required|integer|exists:events,id', // Adjust validation rules as needed
        ]);

        // Retrieve the event details from the database
        $event = Event::find($request->eventId);

        // Return the event details as a JSON response
        return response()->json([
            'success' => true,
            'title' => $event->title,
            // 'description' => $event->description, // Add other fields as needed
            // 'date' => $event->date, // Example field
        ]);
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
            'customer' => 'required|string|max:255', // Ensure customer is sent
            'lec' => 'required|string|max:255', // Ensure lecturer is sent
            'des' => 'required|string|max:255',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'status' => "pending",
            'invoice' => "no",
            'start' => $request->start,
            'lecturer' => $request->lec,
            'description' => $request->des,
            'end' => $request->end ?? $request->start, // Use start date as end date if end is not provided
            'customer' => $request->customer,
            'created_by' => auth()->id() ?? null, // Assuming you want to track who created the event
        ]);

        return response()->json($event, 201);
    }
    // Soft delete an event
    public function destroy($id)
    {

        try {
            $event = Event::findOrFail($id);

            // Soft delete the event
            $event->delete();

            return response()->json(['message' => 'Event deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting event: ' . $e->getMessage()], 500);
        }
    }
    public function complete($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.',
            ], 404);
        }

        $event->status = 'complete';
        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Event marked as complete successfully!',
        ]);
    }



    // public function complete($id)
    // {
    //     $event = Event::find($id);

    //     if (!$event) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Event not found.',
    //         ], 404);
    //     }

    //     // Mark the event as complete
    //     $event->status = 'complete';
    //     $event->save();

    //     // Generate invoice data
    //     $invoiceData = [
    //         'event' => $event,
    //         'date' => now()->format('Y-m-d H:i:s'),
    //         'invoiceNumber' => strtoupper(uniqid('INV-')),
    //     ];

    //     // Generate PDF invoice
    //     $pdf = Pdf::loadView('invoices.template', $invoiceData);

    //     // Return PDF for download or viewing
    //     return $pdf->stream("invoice-{$event->id}.pdf");

    //     // Alternatively, to download:
    //     // return $pdf->download("invoice-{$event->id}.pdf");
    // }

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
