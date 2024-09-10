<x-guest-layout>


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required autofocus autocomplete="name">
            <div class="invalid-feedback">
                Please enter your name
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required>
            <div class="invalid-feedback">
                Please enter your email
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">phone <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">+2 </span>
                <input type="number" class="form-control" name="phone" placeholder="phone" aria-label="phone" aria-describedby="basic-addon1">
            </div>
            
            <div class="invalid-feedback">
                Please enter your phone
            </div>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mb-3">
            <label class="form-label" for="password-input">Password</label>
            <div class="position-relative auth-pass-inputgroup">
                <input type="password" name="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" required>
                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                <div class="invalid-feedback">
                    Please enter password
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="password_confirmation">Confirm password</label>
            <div class="position-relative auth-pass-inputgroup">
                <input type="password" name="password_confirmation" class="form-control pe-5 password-input" placeholder="Confirm password" id="password_confirmation" aria-describedby="passwordInput" required>
                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                <div class="invalid-feedback">
                    Confirm password
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>


        <div class="mt-4">
            <button class="btn btn-success w-100" type="submit">Sign Up</button>
        </div>

       
    </form>


</x-guest-layout>
