@extends('layouts.admin')

@section('title', 'Account Details')

@section('content')
    <div class="container">
        <h1 class="mb-4">Your Account Details</h1>

        @if(is_null($userAccount))  <!-- Check if the user account is null -->
            <div class="alert alert-info">
                No records found.
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <h5>Account Information tester</h5>
                </div>
                <div class="card-body">
                    <form>
                        <!-- Display account number -->
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <input type="text" id="account_number" class="form-control" value="{{ $userAccount->account_number }}" readonly>
                        </div>

                        <!-- Display first name -->
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" class="form-control" value="{{ $userAccount->first_name }}" readonly>
                        </div>

                        <!-- Display last name -->
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" class="form-control" value="{{ $userAccount->last_name }}" readonly>
                        </div>

                        <!-- Display date of birth -->
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="text" id="dob" class="form-control" value="{{ \Carbon\Carbon::parse($userAccount->dob)->format('d-m-Y') }}" readonly>
                        </div>

                        <!-- Display address -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control" value="{{ $userAccount->address }}" readonly>
                        </div>

                        <!-- Display balance -->
                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <input type="text" id="balance" class="form-control" value="{{ number_format($userAccount->balance, 2) }} {{ $userAccount->currency }}" readonly>
                        </div>

                        <!-- Display currency -->
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <input type="text" id="currency" class="form-control" value="{{ $userAccount->currency }}" readonly>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
