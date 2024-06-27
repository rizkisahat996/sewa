@extends('layouts.app')

@section('content')
    <div class="container invoice py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Payment Details</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Transaction #{{ $transaction['id'] }}</h5>
                        <div class="alert alert-info" role="alert">
                            <strong>Total Amount:</strong> ${{ number_format($transaction['total_amount'], 2) }}
                        </div>

                        <div class="mb-4">
                            <h6>Transaction Details:</h6>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-5">
                                    Start Date
                                    <span class="badge bg-primary rounded-pill p-2">{{ $transaction['start_date'] }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-5">
                                    End Date
                                    <span class="badge bg-primary rounded-pill p-2">{{ $transaction['end_date'] }}</span>
                                </li>
                                <!-- Add more transaction details as needed -->
                            </ul>
                        </div>

                        <form action="{{ route('generate.invoice') }}" method="POST">
                            @csrf
                            <input type="hidden" name="transaction_id" value="{{ $transaction['id'] }}">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">Generate Invoice</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        Please review the details before generating the invoice.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border: none;
            border-radius: 1rem;
            transition: all 0.2s;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
        }

        .card-header {
            border-radius: 1rem 1rem 0 0;
        }

        .btn-success {
            font-size: 1.2rem;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
        }
    </style>
@endpush
