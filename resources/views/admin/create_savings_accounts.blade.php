@extends('layouts.admin')

@section('title', 'Create Savings Account')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4 text-center">Create Savings Accounts trster</h1>
  <!-- Display Success or Error Message -->
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
        <form action="{{ route('admin.save_savings_accounts') }}" method="POST">
            @csrf

            <div id="accounts-container">
                <!-- Default Account 1 Fields (Mandatory) -->
                <div class="account-group">
                    <h3>Account 1</h3>

                    <div class="form-group">
                        <label for="user_id[]">Select User</label>
                        <select name="user_id[]" class="form-control" required>
                            <option value="">Select a User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="first_name[]">First Name</label>
                        <input type="text" name="first_name[]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name[]">Last Name</label>
                        <input type="text" name="last_name[]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="dob[]">Date of Birth</label>
                        <input type="date" name="dob[]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="address[]">Address</label>
                        <input type="text" name="address[]" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="balance[]">Balance (INR)</label>
                        <input type="number" name="balance[]" class="form-control" value="10000" >
                    </div>
                </div>
            </div>

            <button type="button" id="addAccount" class="btn btn-secondary mb-3">Add Another Account</button>
            <button type="submit" class="btn btn-primary">Create Savings Accounts</button>
        </form>
    </div>

    <script>
        // Add account dynamically on button click
        document.getElementById('addAccount').addEventListener('click', function() {
            const accountsContainer = document.getElementById('accounts-container');
            const accountCount = accountsContainer.querySelectorAll('.account-group').length + 1;

            const newAccountGroup = document.createElement('div');
            newAccountGroup.classList.add('account-group');
            newAccountGroup.innerHTML = `
                <h3>Account ${accountCount}</h3>

                <div class="form-group">
                    <label for="user_id[]">Select User</label>
                    <select name="user_id[]" class="form-control" required>
                        <option value="">Select a User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="first_name[]">First Name</label>
                    <input type="text" name="first_name[]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="last_name[]">Last Name</label>
                    <input type="text" name="last_name[]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="dob[]">Date of Birth</label>
                    <input type="date" name="dob[]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="address[]">Address</label>
                    <input type="text" name="address[]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="balance[]">Balance (INR)</label>
                    <input type="number" name="balance[]" class="form-control" value="10000" >
                </div>

                <button type="button" class="btn btn-danger remove-account">Remove Account</button>
            `;
            accountsContainer.appendChild(newAccountGroup);
        });

        // Auto-populate user details based on selected user
        // document.getElementById('accounts-container').addEventListener('change', function(event) {
        //     if (event.target.name === 'user_id[]') {
        //         const userId = event.target.value;
        //         if (userId) {
        //             fetch(`/admin/get-user-details/${userId}`)
        //                 .then(response => response.json())
        //                 .then(data => {
        //                     const accountGroup = event.target.closest('.account-group');
        //                     accountGroup.querySelector('input[name="first_name[]"]').value = data.first_name;
        //                     accountGroup.querySelector('input[name="last_name[]"]').value = data.last_name;
        //                     accountGroup.querySelector('input[name="dob[]"]').value = data.dob;
        //                 });
        //         }
        //     }
        // });

        // Remove account dynamically
        document.getElementById('accounts-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-account')) {
                // Prevent removing the first account
                const accountGroup = event.target.closest('.account-group');
                const allAccounts = document.querySelectorAll('.account-group');
                if (allAccounts.length > 1) {
                    accountGroup.remove();
                } else {
                    alert('At least one account must remain!');
                }
            }
        });
    </script>
@endsection
