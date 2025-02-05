<div class="two-factor-container">
        <h2>Two-Factor Authentication (User)</h2>
        <form method="POST" action="{{ route('user.two-factor.store') }}">
            @csrf
            <div>
                <label for="code">Enter the code sent to your email:</label>
                <input type="text" id="code" name="code" required>
            </div>
            <button type="submit">Verify</button>
        </form>
               @if ($errors->has('code'))
        <div class="alert alert-danger">
            {{ $errors->first('code') }}
        </div>
    @endif
    </div>

