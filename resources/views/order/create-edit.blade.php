@extends('layouts.master')

@section('title')
    {{ $title }}
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-sm-0">{{ $title }}</h3>

                    <ol class="breadcrumb m-0 mt-2">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item {{ $breadcrumb['active'] ? 'active' : '' }}">
                                @if (!$breadcrumb['active'])
                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                                @else
                                    {{ $breadcrumb['label'] }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>

                <div class="page-title-right">
                    {{-- Add Buttons Here --}}
                    {{-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                        title="Create">
                        <i class="ri-add-line fs-5"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="card">
            <div class="card-body">
                <form method="POST" class="ajax-form"
                    action="{{ $is_edit ? route('users.update', $data->id) : route('orders.store') }}">
                    @csrf
                    @if ($is_edit)
                        @method('PATCH')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Event</label>
                            <select class="form-control js-example-basic-single" name="role" id="event-select">
                                <option value="" selected>Select...</option>
                                @foreach ($events as $event)
                                    <option value={{ $event->id }}>
                                        {{ $event->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Hours</label>
                            <input type="text" name="hours" id="" class="form-control"
                                value="{{ $is_edit ? $data->name : '' }}" placeholder="Enter hours" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Fee</label>
                            <input type="text" name="fee" id="" class="form-control"
                                value="{{ $is_edit ? $data->name : '' }}" placeholder="Enter fee" />
                        </div>
                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Note</label>
                            <input type="textarea" name="note" id="" class="form-control"
                                value="{{ $is_edit ? $data->email : '' }}" placeholder="Enter note" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label for="" class="form-label">Customer</label>
                            <input type="text" id="customer" disabled name="customer" class="form-control"
                                placeholder="Customer">

                        </div>
                        <div class="col-md-6 mb-3 ">
                            <label for="" class="form-label">Lecturer</label>
                            <input type="text" id="lecturer" disabled name="lecturer" class="form-control"
                                placeholder="Lecturer">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 ">
                            <label for="" class="form-label">Start</label>
                            <input type="text" id="start" disabled name="start" class="form-control"
                                placeholder="start time">

                        </div>
                        <div class="col-md-6 mb-3 ">
                            <label for="" class="form-label">End</label>
                            <input type="text" id="end" disabled name="end" class="form-control"
                                placeholder="end time">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-light me-2"
                                onclick="window.location='{{ route('users.index') }}'">Cancel</button>
                            <button class="btn btn-primary">{{ $is_edit ? 'Update' : 'Create' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ensure the data from Laravel is properly passed
            var eventsData = @json($events); 
            console.log(eventsData); // Log the events data to see if it's being passed correctly
    
            // Listen for change on the event selection dropdown
            $('#event-select').change(function() {
                var selectedEventId = $(this).val(); // Get the selected event ID
                console.log(selectedEventId); // Check the selected ID
              
                // Find the selected event from eventsData
                var selectedEvent = eventsData.find(function(event) {
                    return event.id == selectedEventId;
                });
    
                if (selectedEvent) {
                    // Populate the fields with the corresponding event data
                    $('#customer').val(selectedEvent.customer || ''); // Assuming customer_name exists
                    $('#lecturer').val(selectedEvent.lecturer || ''); // Assuming lecturer_name exists
                    $('#start').val(selectedEvent.start || ''); // Assuming customer_name exists
                    $('#end').val(selectedEvent.end || '');
                } else {
                    // Clear fields if no event is selected
                    $('#customer').val('');
                    $('#lecturer').val('');
                    $('#start').val('');
                    $('#end').val('');
                }
            });
    
            // Optionally, trigger the change event on page load to set initial values (if any)
            if ($('#event-select').val()) {
                $('#event-select').trigger('change');
            }
        });
    </script>
    
@endsection
