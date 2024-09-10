<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autofocus autocomplete="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label class="form-label" for="password-input">Password</label>
            <div class="position-relative auth-pass-inputgroup mb-3">
                <input id="password" class="form-control pe-5 password-input"
                type="password"
                name="password"
                placeholder="Enter password" 
                required 
                autocomplete="current-password">
                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            @if (Route::has('password.request'))
                <div class="float-end">
                    <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                </div>
            @endif

            
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember">
            <label class="form-check-label" for="auth-remember-check">Remember me</label>
        </div>

        <div class="mt-4">
            <button class="btn btn-success w-100" type="submit">Sign In</button>
        </div>

        
    </form>

</x-guest-layout>
