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
        $today = Carbon::today(); // Today's date
        $currentTime = Carbon::now(); // Current time
    
        // Fetch today's events sorted by start time
        $eventsToday = Event::whereDate('start', $today)
            ->orderBy('start')
            ->get(['title', 'start']);
    
        // Default event title
        $eventTitle = "No Events Today";
    
        // Determine the current or next event
        foreach ($eventsToday as $event) {
            $eventTime = Carbon::parse($event->start); // Parse start time
    
            if ($eventTime->greaterThanOrEqualTo($currentTime)) {
                $eventTitle = $event->title;
                break;
            }
        }
    
        // Other statistics
        $totalOrders = Order::count();
        $todayDate = Carbon::now()->toDateString();
        $todayOrders = Order::whereDate('created_at', $todayDate)->count();
        $customers = Customer::count();
        $users = User::count();
    
        return view('home', compact('totalOrders', 'todayOrders', 'customers', 'users', 'eventTitle'));
    }
    
}
