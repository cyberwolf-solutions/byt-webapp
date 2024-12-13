@extends('layouts.master-without-nav')

@section('title')
    Print Order
@endsection

@section('content')
    <style>
        body {
            background-color: #FFF !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="row my-2 justify-content-center text-center">
                <img src="{{ asset('storage/' . $settings->logo_dark) }}" class="img-fluid w-25" alt="">
                <span class="fs-5">BYT webapplication</span>
            </div>
            <div class="row justify-content-between mt-5">
                <div class="col">
                    <h6 style="font-weight: bold">Order No</h6>
                    <span>#{{ $settings->invoice($data->id) }}</span>
                </div>
                <div class="col">
                    <h6 style="font-weight: bold">Order Date</h6>
                    <span>{{ \Carbon\Carbon::parse($data->created_at)->format($settings->date_format) }}</span>
                </div>
                <div class="col">
                    <h6>Order Type</h6>
                    <span>{{ $data->type }}</span>
                </div>
            </div>
            {{-- <hr> --}}
            <div class="row mt-4">
                <div class="col">
                    <h6 style="font-weight: bold">Customer</h6>
                    @if ($data->customer_id == 0)
                        <p>Walking Customer</p>
                    @else
                        <p>{{ $data->customer->name }},</p>
                        <p>{{ $data->customer->contact }},</p>
                        <p>{{ $data->customer->email }},</p>
                        <p>{{ $data->customer->address }}.</p>
                    @endif
                </div>
               
            </div>
            <hr>
            <div class="row">
                <h6 style="font-weight: bold">Detail</h6>
                <div class="col-12">
                    <table class="table table-hover align-middle">
                        <thead>
                           
                            <th>Fee</th>
                            <th>Hours(h)</th>
                            <th>Note</th>
                            <th></th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data->items as $key => $item) --}}
                                <tr>
                                    {{-- <td>{{ $key + 1 }}</td> --}}
                                    <td>{{ $settings->currency }} {{ number_format($data->fee, 2) }}</td>
                                    <td>{{ $data->hours }}</td>
                                    <td>{{ $data->note }}</td>
                                    {{-- <td>{{ $settings->currency }} {{ number_format($item->total, 2) }}</td> --}}
                                </tr>
                       
                            {{-- @endforeach --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    Sub Total
                                </td>
                                <td>
                                    {{ $settings->currency }}
                                    {{ number_format($data->fee ? $data->fee : 0, 2) }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td colspan="3"></td>
                                <td>
                                    Discount
                                </td>
                                <td>
                                    {{ $settings->currency }}
                                    {{ number_format($data->payment ? $data->payment->discount : 0, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    VAT
                                </td>
                                <td>
                                    {{ $settings->currency }}
                                    {{ number_format($data->payment ? $data->payment->vat : 0, 2) }}
                                </td>
                            </tr> --}}
                            {{-- <tr>
                                <td colspan="3"></td>
                                <td>
                                    Service charge
                                </td>
                                <td>
                                    {{ $settings->currency }}
                                    {{ number_format($data->payment ? $data->payment->service : 0, 2) }}
                                </td>
                            </tr> --}}
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    <h5 class="fw-bold">Total</h5>
                                </td>
                                <td>
                                    <h5 class="fw-bold">{{ $settings->currency }}
                                        {{ number_format($data->fee ? $data->fee : 0, 2) }}</h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endsection
