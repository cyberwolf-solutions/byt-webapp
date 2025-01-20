@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h2>Event Calendar</h2>
        <div id="calendar"></div>
    </div>

    <div id="addEventModal" style="display: none;" class="modal">
        <div class="modal-content">
            <h4>Add Event</h4>
            <label for="newEventTitle">Event Title:</label>
            <input type="text" id="newEventTitle" />

            <label for="newEventTitle">Description:</label>
            <input type="text" id="newEventDes" />

            <label for="startTime">From (Start Time):</label>
            <input type="time" id="startTime" required>

            <label for="endTime">To (End Time):</label>
            <input type="time" id="endTime" required>


            <label for="customerSelect">Select Customer:</label>
            <select id="customerSelect" required name="customer">
                <option value="" disabled selected>Select a customer</option>
                @foreach ($customer as $cust)
                    <option value="{{ $cust->name }}">{{ $cust->name }}</option>
                @endforeach
            </select>


            <label for="lecSelect">Select Lecturer:</label>
            <select id="lecSelect" required name="lec">
                <option value="" disabled selected>Select a Lecturer</option>
                @foreach ($lec as $cust11)
                    <option value="{{ $cust11->name }}">{{ $cust11->name }}</option>
                @endforeach
            </select>

            <button id="saveEvent" class="btn btn-primary">Save</button>
            <button id="cancelAdd" class="btn btn-secondary">Cancel</button>
        </div>
    </div>


    <!-- Edit Event Modal -->
    <div id="editEventModal" style="display: none;" class="modal">
        <div class="modal-content">
            <h4>Edit Event</h4>
            <label for="eventTitle">Event Title:</label>
            <input type="text" id="eventTitle" />
            
            <label for="startTime">From (Start Time):</label>
            <input type="time" id="startTime" required>
    
            <label for="endTime">To (End Time):</label>
            <input type="time" id="endTime" required>
    
            <label for="customerSelect1">Select Customer:</label>
            <select id="customerSelect1" required>
                <option value="" disabled>Select a customer</option>
                @foreach ($customer as $cust)
                    <option value="{{ $cust->name }}">{{ $cust->name }}</option>
                @endforeach
            </select>
    
            <label for="lecSelect1">Select Lecturer:</label>
            <select id="lecSelect1" required>
                <option value="" disabled selected>Select a Lecturer</option>
                @foreach ($lec as $cust1)
                    <option value="{{ $cust1->name }}">{{ $cust1->name }}</option>
                @endforeach
            </select>
            <button id="updateEvent" class="btn btn-primary">Update</button>
            <button id="cancelEdit" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
    
        <!-- viewEvent Event Modal -->
        <div id="viewEventModal" style="display: none;" class="modal">
            <div class="modal-content">
                <h4>View Event</h4>
                <label for="eventTitle">Event Title:</label>
                <input type="text" disabled id="eventTitle" />
                
                <label for="startTime">From (Start Time):</label>
                <input type="time" disabled id="startTime" required>
        
                <label for="endTime">To (End Time):</label>
                <input type="time" disabled id="endTime" required>
        
                <label for="customerSelect1">Select Customer:</label>
                <select id="customerSelect1" required disabled>
                    <option value="" disabled>Select a customer</option>
                    @foreach ($customer as $cust)
                        <option value="{{ $cust->name }}">{{ $cust->name }}</option>
                    @endforeach
                </select>
        
                <label for="lecSelect1">Select Lecturer:</label>
                <select id="lecSelect1" required disabled>
                    <option value="" disabled selected>Select a Lecturer</option>
                    @foreach ($lec as $cust1)
                        <option value="{{ $cust1->name }}">{{ $cust1->name }}</option>
                    @endforeach
                </select>
                {{-- <button id="updateEvent" class="btn btn-primary">Update</button> --}}
                <button id="cancelView" class="btn btn-secondary">Cancel</button>
            </div>
        </div>

    <!-- Delete or Edit Event Modal -->
    <div id="deleteEditModal" style="display: none;" class="modal">
        <div class="modal-content">
            <h4>Event Options</h4>
            <p>What would you like to do with this event?</p>
            <button id="editEvent" class="btn btn-primary">Edit</button>
            <button id="viewEvent" class="btn btn-success">View</button>
            <button id="confirmDelete" class="btn btn-danger">Delete</button>
            <button id="cancelDelete" class="btn btn-secondary">Cancel</button>
        </div>
    </div>


    <style>
        /* Simple Modal Styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black with opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        button {
            margin: 5px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'timeGrid', 'interaction'],
                initialView: 'dayGridMonth', // Default view on page load
                headerToolbar: {
                    left: 'prev,next today', // Navigation buttons
                    center: 'title', // Title of the calendar
                    right: 'dayGridMonth,timeGridWeek,timeGridDay' // View buttons
                },
                views: {
                    dayGridMonth: {
                        buttonText: 'Month'
                    },
                    timeGridWeek: {
                        buttonText: 'Week'
                    },
                    timeGridDay: {
                        buttonText: 'Day'
                    }
                },
                events: function(info, successCallback, failureCallback) {
                    // Fetch events via the API
                    fetch('/events')
                        .then(response => response.json())
                        .then(data => successCallback(data))
                        .catch(error => failureCallback(error));
                },
                dateClick: function(info) {
                    // Prompt to add new event
                    var customertitle = prompt('Enter event title:');
                    if (title) {
                        fetch('/events', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    title: title,
                                    start: info.dateStr,
                                    end: info.dateStr
                                })
                            })
                            .then(response => response.json())
                            .then(event => {
                                calendar.addEvent(event);
                            })
                            .catch(error => alert('Error creating event: ' + error));
                    }
                },
                eventClick: function(info) {
                    // Display event details on click
                    alert('Event clicked: ' + info.event.title);
                },
                eventColor: '#378006', // Green events (for example)
                eventTextColor: '#fff', // White text color for the events
                eventBorderColor: '#fff', // White border around events
                eventBackgroundColor: '#378006', // Green background for events
                editable: true, // Allow dragging and resizing of events
                droppable: true, // Allow events to be dropped into the calendar
                droppable: true // Enable drag-and-drop functionality
            });

            calendar.render();
        });
    </script>
    <script>
        const storeEventUrl = "{{ route('event.store') }}";
    </script>
@endsection
