<?php

namespace App\Http\Controllers;

use App\Models\Expencestype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ExpencestypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $title = 'Expense Type';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];

        $status = $request->status;

        $data = Expencestype::all();

        return view('expensetype.index', compact('title', 'breadcrumbs', 'data', 'status'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $title = 'Expense Type';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => route('users.index'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true],
        ];
      

        $is_edit = false;

        return view('expensetype.create-edit', compact('title', 'breadcrumbs', 'is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'type' => 'required',
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
                'type' => $request->type,
            ];

            $order = Expencestype::create($data);

            // return response()->json(['success' => true, 'message' => 'Order Placed!', 'url' => route('order.print', [$order->id])]);
            return json_encode(['success' => true, 'message' => 'Expense created', 'url' => route('expensetype.index')]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!' . $th]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expencestype $expencestype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expencestype $expencestype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expencestype $expencestype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expencestype $expencestype)
    {
        //
    }
}
