<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Purchases;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function user()
    {
        $title = 'User Report';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];
        $data = User::with('roles')->get();


        return view('reports.Userindex', compact('title', 'breadcrumbs', 'data'));
    }

    public function customer()
    {
        $title = 'Guest Report';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];
        $data = Customer::all();


        return view('reports.customerindex', compact('title', 'breadcrumbs', 'data'));
    }
    // public function employee()
    // {
    //     $title = 'Employees Report';

    //     $breadcrumbs = [
    //         // ['label' => 'First Level', 'url' => '', 'active' => false],
    //         ['label' => $title, 'url' => '', 'active' => true],
    //     ];
    //     $data = Employee::all();


    //     return view('reports.employeeindex', compact('title', 'breadcrumbs', 'data'));
    // }
    // public function supplier()
    // {
    //     $title = 'Supplier Report';

    //     $breadcrumbs = [
    //         // ['label' => 'First Level', 'url' => '', 'active' => false],
    //         ['label' => $title, 'url' => '', 'active' => true],
    //     ];
    //     $data = Supplier::all();


    //     return view('reports.supplierindex', compact('title', 'breadcrumbs', 'data'));
    // }
    // public function purchase()
    // {
    //     $title = 'Purchase Report';

    //     $breadcrumbs = [
    //         // ['label' => 'First Level', 'url' => '', 'active' => false],
    //         ['label' => $title, 'url' => '', 'active' => true],
    //     ];
    //     $data = Purchases::with(['supplier', 'items.product', 'payments'])->get();


    //     return view('reports.purchaseindex', compact('title', 'breadcrumbs', 'data'));
    // }
    public function product()
    {
        $title = 'Expenses Report';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];
        $data = Expense::all();


        return view('reports.productindex', compact('title', 'breadcrumbs', 'data'));
    }

    // public function booking()
    // {
    //     $title = 'Booking Report';

    //     $breadcrumbs = [
    //         // ['label' => 'First Level', 'url' => '', 'active' => false],
    //         ['label' => $title, 'url' => '', 'active' => true],
    //     ];
    //     $data = Booking::all();
    //     return view('reports.bookingindex', compact('title', 'breadcrumbs', 'data'));
    // }
    public function order()
    {
        $title = 'Order Report';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];
        $data = Order::all();
        return view('reports.orderindex', compact('title', 'breadcrumbs', 'data'));
    }

    public function searchByType(Request $request)
    {
        $title = 'Order Report';

        $breadcrumbs = [
            // ['label' => 'First Level', 'url' => '', 'active' => false],
            ['label' => $title, 'url' => '', 'active' => true],
        ];
        $type = $request->type;
        if ($type === 'All') {
            $data = Order::all(); // Fetch all orders when "All" is selected
        } else {
            $data = Order::where('type', $type)->get(); // Filter by the selected type
        }
        // $data = Order::where('type', $type)->get();

        // return response()->json($data);
        return view('reports.orderindex', compact('title', 'breadcrumbs', 'data'));

    }
}