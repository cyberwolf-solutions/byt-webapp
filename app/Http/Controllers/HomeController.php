<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Order;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {


        $today = Carbon::today();
        $totalOrders = Order::all()->count();
        
        $todayDate = Carbon::now()->toDateString();

   
        
        $eventToday = Event::whereDate('start', $today)->first(['title']); // Adjust 'start' if needed

        // Retrieve the title of today's event, if it exists
        $eventTitle = $eventToday ? $eventToday->title : "No Events Today";
        $totalOrders = Order::all()->count();
        
        $todayDate = Carbon::now()->toDateString();


        $todayOrders = Order::whereDate('created_at', $todayDate)->count();


        $customers = Customer::all()->count();

        

        $users = User::all()->count();


        return view('home', compact('totalOrders', 'todayOrders' ,'customers' ,'users','eventTitle' ));
    }
}
