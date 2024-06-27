@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Transactions</h1>
        @if(count($transactions) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Building</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th> <!-- Added Action column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->building->description }}</td>
                            <td>{{ $transaction->total_amount }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>
                                <a href="{{ route('payment', $transaction->id) }}" class="btn btn-primary">View</a>
                            </td> <!-- Added Action button -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No transactions found.</p>
        @endif
    </div>
@endsection
