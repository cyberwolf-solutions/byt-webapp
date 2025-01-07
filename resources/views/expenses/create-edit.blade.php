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
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="card">
            <div class="card-body">
                <form method="POST" class="ajax-form"
                    action="{{ $is_edit ? route('users.update', $data->id) : route('expense.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($is_edit)
                        @method('PATCH')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" id="" class="form-control"
                                value="{{ $is_edit ? $data->name : '' }}" placeholder="Enter title" />
                        </div>
                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Amount</label>
                            <input type="text" name="fee" id="" class="form-control"
                                value="{{ $is_edit ? $data->name : '' }}" placeholder="Enter fee" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Note</label>
                            <input type="textarea" name="note" id="" class="form-control"
                                value="{{ $is_edit ? $data->email : '' }}" placeholder="Enter note" />
                        </div>

                        <div class="col-md-6 mb-3 required">
                            <label for="" class="form-label">Expense type</label>
                            <select class="form-select form-select" name="type" aria-label="Small select example">
                                <option selected>Open this select menu</option>
                                @foreach ($data as $key => $item)
                                    <option value="{{ $item->type }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- File upload -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="document" class="form-label">Upload Document</label>
                            <input type="file" name="document" id="document" class="form-control" />
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
@endsection
