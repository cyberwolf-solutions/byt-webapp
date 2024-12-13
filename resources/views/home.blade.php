@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container mt-2">
        <div class="row">
            <!-- Total Users -->
            <div class="col-12 col-md-3 mb-4">
                <div class="card shadow border-0 bg-gradient-blue text-center p-4" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title  display-4 mb-2">{{ $users }}</h5>
                        <p style="color: #864e0a" class="card-text  fw-bold">Total Users</p>
                    </div>
                </div>
            </div>
        
            <!-- Total Customers -->
            <div class="col-12 col-md-3 mb-4">
                <div class="card shadow border-0 bg-gradient-gray text-center p-4" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title display-4 mb-2">{{ $customers }}</h5>
                        <p style="color: #713c3c" class="card-text  fw-bold">Total Customers</p>
                    </div>
                </div>
            </div>
        
            <!-- Today's Orders -->
            <div class="col-12 col-md-3 mb-4">
                <div class="card shadow border-0 bg-gradient-green text-center p-4" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title display-4 mb-2">{{ $todayOrders }}</h5>
                        <p style="color: rgb(1, 98, 4)" class="card-text  fw-bold">Today Orders</p>
                    </div>
                </div>
            </div>
        
            <!-- Total Orders -->
            <div class="col-12 col-md-3 mb-4">
                <div class="card shadow border-0 bg-gradient-beige text-center p-4" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title display-4 mb-2">{{ $totalOrders }}</h5>
                        <p style="color: #461752" class="card-text  fw-bold">Total Orders</p>
                    </div>
                </div>
            </div>
        
            <!-- Today Event -->
            <div class="col-12 mb-4">
                <div class="card shadow border-0 bg-gradient-teal text-center p-4" style="border-radius: 15px;">
                    <div class="card-body">
                        <h5 class="card-title  display-4 mb-2">{{ $eventTitle }}</h5>
                        <p style="color: #356e6c" class="card-text  fw-bold" >Today Event</p>
                    </div>
                </div>
            </div>
        </div>
        
        
        
    </div>


    {{-- <div class="row mt-3">
        <div class="card border col-11  mx-auto">
            <div class="card-body">
                <div class="col-12">
                    <h5 class="card-title">Today Orders</h5>
                    <hr style="border-top: 2px solid #007bff; font-weight: bold;">
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless table-hover datatable">
                            <thead>
                                <th>No.</th>
                                <th>Guest</th>
                                <th>Placed By</th>
                                <th>Hours</th>
                                <th>Total</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($todayOrders as $item)
                                    <tr>
                                        <td>#{{ $settings->invoice($item->id) }}</td>
                                        @if ($item->customer_id == 0)
                                            <td>Walking Customer</td>
                                        @else
                                            <td>{{ $item->customer->name }}</td>
                                        @endif
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->hours }}</td>
                                        <td>{{ $settings->currency }}
                                            {{ number_format($item->fee ? $item->fee : 0, 2) }}
                                        </td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="row mt-3">
        <div class="card border col-11  mx-auto">
            <div class="card-body">
                <div class="col-12">
                    <h5 class="card-title">Today Bookings</h5>
                    <hr style="border-top: 2px solid #007bff; font-weight: bold;">
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless table-hover datatable">
                            <thead>
                                <th>No.</th>
                                <th>Guest</th>
                                <th>Placed By</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($todayBookings as $item)
                                    <tr>
                                        <td>#{{ $settings->invoice($item->id) }}</td>
                                        @if ($item->customer_id == 0)
                                            <td>Walking Customer</td>
                                        @else
                                            <td>{{ $item->customers->name }}</td>
                                        @endif
                                        <td>{{ $item->createdBy->name }}</td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
    
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Check if the browser supports notifications
            if ('Notification' in window) {
                // Request permission to display notifications
                Notification.requestPermission();
            } else {
                alert('This browser does not support desktop notifications.');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            var finalCount = {{ $customers->count() }};
            var currentCount = 0;
            var increment = 1;
            var speed = 10;

            var counter = setInterval(function() {
                $('.stock-change').text(currentCount);
                currentCount += increment;
                if (currentCount > finalCount) {
                    clearInterval(counter);
                }
            }, speed / finalCount);
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            var finalCount = {{ $employees->count() }};
            var currentCount = 0;
            var increment = 1;
            var speed = 10;

            var counter = setInterval(function() {
                $('.stock-change1').text(currentCount);
                currentCount += increment;
                if (currentCount > finalCount) {
                    clearInterval(counter);
                }
            }, speed / finalCount);
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            var finalCount = {{ $suppliers->count() }};
            var currentCount = 0;
            var increment = 1;
            var speed = 10;

            var counter = setInterval(function() {
                $('.stock-change2').text(currentCount);
                currentCount += increment;
                if (currentCount > finalCount) {
                    clearInterval(counter);
                }
            }, speed / finalCount);
        });
    </script> --}}
@endsection
