@extends('layouts.app')

@section('content')
    <div class="container invoice mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="mb-3">{{ $seller['name'] }}</h2>
                        <div>{{ $seller['address'] }}</div>
                        <div>{{ $seller['email'] }}</div>
                        <div>{{ $seller['phone'] }}</div>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <h2 class="mb-3">Invoice #{{ $invoice['id'] }}</h2>
                        <div>Date: {{ \Carbon\Carbon::parse($invoice['created_at'])->format('m/d/Y') }}</div>
                        <div>Due Date: {{ \Carbon\Carbon::parse($invoice['created_at'])->addDays(30)->format('m/d/Y') }}
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Bill To:</h6>
                        <div><strong>{{ $renter['name'] }}</strong></div>
                        <div>{{ $renter['address'] }}</div>
                        <div>{{ $renter['email'] }}</div>
                        <div>{{ $renter['phone'] }}</div>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Rate</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rent for {{ $building['description'] }}</td>
                                <td>{{ $transaction['start_date'] }}</td>
                                <td>{{ $transaction['end_date'] }}</td>
                                <td>${{ $building['rent_price'] }} / 24 hours</td>
                                <td class="text-right">${{ $transaction['total_amount'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left"><strong>Total</strong></td>
                                    <td class="right">${{ $transaction['total_amount'] }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Paid Status</strong></td>
                                    <td class="right">{{ ucfirst($invoice['status']) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h6>Thank you for your business!</h6>
                        <p class="text-muted">If you have any questions concerning this invoice, please contact:</p>
                        <p class="text-muted">{{ $seller['email'] }}</p>
                        <p class="text-muted">{{ $seller['phone'] }}</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <p class="text-muted text-center">© {{ date('Y') }} {{ $seller['name'] }}. All rights
                            reserved.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button onclick="window.print()" class="btn btn-primary"><i class="fa fa-print mr-1"></i>
                            Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
