<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $title = 'Lecturer';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];
        $data = Lecturer::all();
        return view('lecturer.index', compact('title', 'breadcrumbs', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Lecturer';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => route('customers.index'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true],
        ];

        $is_edit = false;

        return view('lecturer.create-edit', compact('title', 'breadcrumbs', 'is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:customers,name',
            'contact' => 'required|unique:customers,contact',
            'email' => 'nullable|email|unique:customers,email',
            'address' => 'nullable'
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
                'name' => $request->name,
                'contact' => $request->contact,
                'email' => $request->email,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
            ];

            $customer = Lecturer::create($data);

            return json_encode(['success' => true, 'message' => 'Lecturer created', 'modal' => true,]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!' . $th]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $data = Lecturer::find($id);

        $settings = Settings::latest()->first();

        $html = '<table class="table" cellspacing="0" cellpadding="0">';
        $html .= '<tr>';
        $html .= '<td>Name: </td>';
        $html .= '<td>' . $data->name . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Contact </td>';
        $html .= '<td>' . $data->contact . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Email: </td>';
        $html .= '<td>' . $data->email . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Address: </td>';
        $html .= '<td>' . $data->address . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Created By: </td>';
        $html .= '<td>' . $data->createdBy->name . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Created Date: </td>';
        $html .= '<td>' . date_format(new DateTime('@' . strtotime($data->created_at)), $settings->date_format) . '</td>';
        $html .= '</tr>';
        $html .= '</table>';

        return response()->json([$html]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $title = 'Lecturers';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => route('customers.index'), 'active' => false],
            ['label' => 'Edit', 'url' => '', 'active' => true],
        ];

        $is_edit = true;
        $data = Lecturer::find($id);

        return view('lecturer.create-edit', compact('title', 'breadcrumbs', 'is_edit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        try {
            $customer = Lecturer::find($lecturer);
            $customer->update(['deleted_by' => Auth::user()->id]);
            $customer->delete();

            return json_encode(['success' => true, 'message' => 'Customer deleted', 'url' => route('customers.index')]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!']);
        }
    }
}
