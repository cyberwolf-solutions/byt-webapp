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
                    <form action="" id="form">
                        <div class="row">
                            {{-- Add other filter options here --}}
                            <a href="{{ route('expense.create') }}" class="btn btn-primary btn-icon"
                                data-bs-toggle="tooltip" title="Create">
                                <i class="ri-add-line"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle" id="example">
                        <thead class="table-light">
                            <th>#</th>
                            <th>Title</th>
                            <th>Note</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Document</th> {{-- Add Document column --}}
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>#{{ $settings->invoice($item->id) }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->notes }}</td>
                                    <td>{{ $settings->currency }} {{ number_format($item->total ? $item->total : 0, 2) }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format($settings->date_format) }}</td>

                                    {{-- Check if the document exists and display it --}}
                                    <td>
                                        @if ($item->document)
                                            {{-- If a document exists, provide a link to view or download --}}
                                            <a href="{{ asset('storage/' . $item->document) }}" target="_blank" class="btn btn-sm btn-info">
                                                View Document
                                            </a>
                                        @else
                                            No Document
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
