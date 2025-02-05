<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <title>Bank Application :Sign In</title>

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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Two Factor Authentication') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('two-factor.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="code">{{ __('Enter the authentication code sent to your email') }}</label>
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Verify') }}
                                </button>
                            </div>
                        </form>
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
