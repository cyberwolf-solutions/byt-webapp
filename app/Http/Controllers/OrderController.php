<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Settings;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendWelcomeEmail;
use App\Models\Event;
use App\Models\Lecturer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Invoice';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];

        $status = $request->status;

        $data = Order::all();

        if ($status) {
            $data = $data->where('status', $status);
        }

        return view('order.index', compact('title', 'breadcrumbs', 'data', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Invoice';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => route('users.index'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true],
        ];
        $customer = Customer::all();
        $events = Event::where('invoice', 'no')->get();
        $lec = Lecturer::all();

        $is_edit = false;

        return view('order.create-edit', compact('title', 'breadcrumbs', 'customer', 'events', 'lec', 'is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'hours' => 'required',
            'fee' => 'required',
            'note' => 'required',
            'role' => 'required|exists:events,id', // Ensure the event ID exists in the events table
        ]);
    
        if ($validator->fails()) {
            $all_errors = null;
    
            foreach ($validator->errors()->messages() as $errors) {
                foreach ($errors as $error) {
                    $all_errors .= $error . "<br>";
                }
            }
    
            return response()->json(['success' => false, 'message' => $all_errors]);
        }
    
        try {
            $event = Event::where('id', $request->role)
            ->first();

    
            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pending event not found.',
                ], 404);
            }
    
            // Create the order
            $data = [
                'event' => $event->id, // Use the event title here
                'hours' => $request->hours,
                'fee' => $request->fee,
                'note' => $request->note,
                'created_by' => Auth::user()->id
            ];
    
            $order = Order::create($data);
    
            // Update event status and invoice column
            // $event->status = 'complete';
            $event->invoice = 'yes'; // Update the invoice column to 'yes'
            $event->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Invoice created',
                'url' => route('orders.index'),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! ' . $th->getMessage(),
            ]);
        }
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Order::find($id);
        return view('order.show', compact('data'));
    }
    public function print(string $id)
    {
        $data = Order::find($id);
        return view('order.print', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
