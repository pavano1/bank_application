@extends('layouts.admin')

@section('title', 'Amount Transfer')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4 text-center">Transfer Amount</h1>

        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="from_savings_account_id">Select From Savings Account</label>
                <select name="from_savings_account_id" id="from_savings_account_id" class="form-control" required>
                    <option value="">Select From Account</option>
                    @foreach($savingsAccounts as $account)
                        <option value="{{ $account->id }}">{{ $account->account_number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="to_savings_account_id">Select To Savings Account</label>
                <select name="to_savings_account_id" id="to_savings_account_id" class="form-control" required>
                    <option value="">Select To Account</option>
                    @foreach($savingsAccounts as $account)
                        <option value="{{ $account->id }}">{{ $account->account_number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount to Transfer</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="currency">Currency</label>
                <select name="currency" id="currency" class="form-control">
                    <option value="INR">INR</option>
                    <option value="USD">USD</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Transfer</button>
        </form>
    </div>
@endsection
