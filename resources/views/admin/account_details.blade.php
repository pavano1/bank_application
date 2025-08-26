@extends('layouts.admin')

@section('title', 'Account Details')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Account Details testet</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($accounts->isEmpty())
            <div class="alert alert-info">
                No records found.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Account Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Balance</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->account_number }}</td>
                            <td>{{ $account->first_name }}</td>
                            <td>{{ $account->last_name }}</td>
                            <td>{{ $account->dob }}</td>
                            <td>{{ $account->address }}</td>
                            <td>{{ $account->balance }} {{ $account->currency }}</td>
                            <td>
                                <span class="badge bg-success">Approved</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
