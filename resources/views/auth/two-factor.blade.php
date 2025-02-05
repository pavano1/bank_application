
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Two-Factor Authentication') }}</div>

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

