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

class OrderController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
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
    public function create() {
        $title = 'Invoice';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => route('users.index'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true],
        ];
        $customer = Customer::all();

        $is_edit = false;

        return view('order.create-edit', compact('title', 'breadcrumbs', 'customer', 'is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'hours' => 'required',
            'fee' => 'required',
            'note' => 'required',
            'role' => 'required',
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
            $data = [
                'customer_id' => $request->role,
                'hours' => $request->hours,
                'fee' => $request->fee,
                'note' => $request->note,
                'created_by' => Auth::user()->id
            ];

            $order = Order::create($data);

            return response()->json(['success' => true, 'message' => 'Invoice Placed!', 'url' => route('order.print', [$order->id])]);
            // return json_encode(['success' => true, 'message' => 'Invoice created', 'url' => route('orders.index')]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!' . $th]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $data = Order::find($id);
        return view('order.show', compact('data'));
    }
    public function print(string $id) {
        $data = Order::find($id);
        return view('order.print', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
    }
}
