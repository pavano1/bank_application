<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <title>Bank Application : Sign Up</title>

    <!-- Add your JS and CSS files using Vite -->
    @vite('resources/js/app.js') <!-- Add your js files -->
    @vite('resources/css/app.css') <!-- Add your css files -->

    <!-- Using Laravel's asset() helper to reference the favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Using Laravel's asset() helper to reference the CSS files -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css') }}">
</head>

<body class="theme-black">
    <div class="authentication">
        <div class="container">
            <div class="col-md-12 content-center">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="company_detail">
                            <!-- Using asset() for image path -->
                            <img style="width: 250px; border-radius: 10px;" src="{{ asset('assets/img/small-logo.png') }}" alt="">
                            <h2>Bank Application Registration</h2>
                            <p>Create an account to access the  panel</p>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-lg-5 col-md-12 offset-lg-1">
                        <div class="card-plain">
                            <div class="header">
                                <h5>Sign Up</h5>
                            </div>
                           <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Email Input -->
    <div class="input-group">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required />
    </div>

    <!-- Password Input -->
    <div class="input-group">
        <input type="password" placeholder="Password" class="form-control" name="password" required />
    </div>

    <!-- Confirm Password Input -->
    <div class="input-group">
        <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required />
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Register</button>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Using asset() to link to the JS files -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
</body>

</html>
