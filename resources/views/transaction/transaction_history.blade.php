@extends('layouts.admin')

@section('title', 'Transaction History')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4 text-center">Transaction History</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Debited Account</th>
                    <th>Credited Account</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->debitedAccount->account_number ?? 'N/A' }}</td>
                        <td>{{ $transaction->creditedAccount->account_number ?? 'N/A' }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->currency }}</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
