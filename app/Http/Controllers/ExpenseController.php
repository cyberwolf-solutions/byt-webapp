<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ExpenseController extends Controller
{
    
    public function index(Request $request) {
        $title = 'Expenses';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];

        $status = $request->status;

        $data = Expense::all();

        if ($status) {
            $data = $data->where('status', $status);
        }

        return view('expenses.index', compact('title', 'breadcrumbs', 'data', 'status'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $title = 'Expenses';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => route('users.index'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true],
        ];
      

        $is_edit = false;

        return view('expenses.create-edit', compact('title', 'breadcrumbs', 'is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'fee' => 'required',
            'note' => 'required',
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
                'title' => $request->title,
                'total' => $request->fee,
                'notes' => $request->note,
                'user_id' => Auth::user()->id
            ];

            $order = Expense::create($data);

            // return response()->json(['success' => true, 'message' => 'Order Placed!', 'url' => route('order.print', [$order->id])]);
            return json_encode(['success' => true, 'message' => 'Expense created', 'url' => route('expense.index')]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!' . $th]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
