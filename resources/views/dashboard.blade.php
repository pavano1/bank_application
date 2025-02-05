@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to Your Dashboard, {{ Auth::user()->email }}</h1>

    @if(Auth::user()->isAdmin())
        <h2>Admin Section</h2>
        <p>Welcome, Admin! Here is the admin-specific content.</p>
        <!-- Admin-specific dashboard content goes here -->
    @else
        <h2>User Section</h2>
        <p>Welcome, User! Here is your user-specific content.</p>
        <!-- User-specific dashboard content goes here -->
    @endif
</body>
</html>

@endsection
