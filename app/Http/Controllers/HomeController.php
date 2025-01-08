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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::today(); // Today's date
        $currentTime = Carbon::now(); // Current time
    
        // Fetch today's events sorted by start time, excluding 'complete' status
        $eventsToday = Event::whereDate('start', $today)
            ->where('status', '!=', 'complete')
            ->orderBy('start')
            ->get(['title', 'start', 'end', 'id', 'customer']); // Include 'customer' and 'end' in the query
    
        // Default values
        $eventTitle = "No Events Today";
        $eventId = null;
        $ecus = "No Customer Assigned"; // Default value for $ecus
        $customerName = "No Customer Assigned"; // Default value for $customerName
        $eventTime = null; // Default value for $eventTime
        $end = null; // Default value for $end
    
        // Determine the current or next event
        foreach ($eventsToday as $event) {
            $eventTime = Carbon::parse($event->start); // Parse start time
    
            if ($eventTime->greaterThanOrEqualTo($currentTime)) {
                $eventTitle = $event->title;
                $eventId = $event->id;
                $end = Carbon::parse($event->end); // Parse end time
    
                // Fetch customer name via relationship or directly
                $customerName = $event->customer ?? "No Customer Assigned"; // Handle missing customer
                break;
            }
        }
    
        // Other statistics
        $totalOrders = Order::count();
        $todayDate = Carbon::now()->toDateString();
        $todayOrders = Order::whereDate('created_at', $todayDate)->count();
        $customers = Customer::count();
        $users = User::count();
    
        // Return the view with all data
        return view('home', compact('totalOrders', 'todayOrders', 'customers', 'users', 'eventTitle', 'eventId', 'customerName', 'eventTime', 'end'));
    }
    
}
