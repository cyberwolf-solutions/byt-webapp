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
                <div class="card shadow border-0 bg-gradient-teal text-center p-4"
                    style="border-radius: 15px; position: relative;">
                    <div class="card-body">
                        <!-- Action Button with Three Dots -->
                        <div style="position: absolute; top: 10px; right: 10px;">
                            <button class="btn btn-link text-white p-0" onclick="toggleActionsMenu(this)">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <!-- Actions Menu -->
                            <div class="actions-menu shadow"
                                style="display: none; position: absolute; right: 0; background: white; border-radius: 5px; z-index: 10; min-width: 150px;">
                                <ul class="list-unstyled m-0 p-2 text-start">
                                    <li>
                                        <button class="btn btn-link text-dark w-100 text-start"
                                            onclick="completeEvent('{{ $eventId }}')">Complete</button>
                                    </li>
                                    <li>
                                        <button class="btn btn-link text-danger w-100 text-start"
                                            onclick="deleteEvent('{{ $eventId }}')">Delete</button>
                                    </li>
                                    <li>
                                        <button class="btn btn-link text-secondary w-100 text-start"
                                            onclick="cancelAction()">Cancel</button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Event Title and Description -->
                        <h5 class="card-title display-4 mb-2">{{ $eventTitle }}</h5>
                        <h6 style="color: #461752">customer :</h6>
                        <h5 class="card-title display-4 mb-2">{{ $customerName }}</h5>
                        <h5 class="card-title display-4 mb-2">{{ $eventTime }} - {{ $end }}</h5>
                        <h5 class="card-title display-4 mb-2"></h5>


                        <p style="color: #356e6c" class="card-text fw-bold">Today Event</p>
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

    <script>
        // Toggle the actions menu
        function toggleActionsMenu(button) {
            const menu = button.nextElementSibling;
            menu.style.display = menu.style.display === 'none' || menu.style.display === '' ? 'block' : 'none';
        }

        // Close the menu on cancel
        function cancelAction() {
            const openMenus = document.querySelectorAll('.actions-menu');
            openMenus.forEach(menu => menu.style.display = 'none');
        }

        // Handle the "Complete" action
        function completeEvent(eventId) {
            // Replace 'id' in the URL with the actual event ID
            const url = completeEventUrl.replace('id', eventId);

            // Confirm the event completion
            if (!confirm("Are you sure you want to mark this event as complete?")) {
                return;
            }

            // Make the POST request to the server
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to mark event as complete');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message || 'Event marked as complete successfully!');
                        location.reload(); // Optionally refresh the page
                    } else {
                        alert(data.message || 'Something went wrong!');
                    }
                })
                .catch(error => {
                    alert('Error marking event as complete: ' + error.message);
                });
        }


        // Handle the "Delete" action
        function deleteEvent(eventId) {
            // alert(eventId);
            // alert(eventTitle);
            if (confirm('Are you sure you want to delete this event?')) {
                // Replace :id with the actual event ID in the URL
                const url = deleteEventUrl.replace('id', eventId);

                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to delete event');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert('Event deleted successfully!');
                        location.reload(); // Optionally refresh the page
                    })
                    .catch(error => {
                        alert('Error deleting event: ' + error.message);
                    });
            }
            cancelAction(); // Close the actions menu
        }


        // Close the menu if clicked outside
        document.addEventListener('click', function(e) {
            const menus = document.querySelectorAll('.actions-menu');
            menus.forEach(menu => {
                if (!menu.contains(e.target) && !menu.previousElementSibling.contains(e.target)) {
                    menu.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        const deleteEventUrl = "{{ route('events.destroy', 'id') }}";
        const completeEventUrl = "{{ route('events.complete', 'id') }}";
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
