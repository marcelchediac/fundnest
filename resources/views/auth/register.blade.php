<x-layout>
    <main class="d-flex w-100 align-items-center justify-content-center"
        style="min-height:100vh;
        background:linear-gradient(rgba(18, 18, 221, 0.78),rgba(71, 18, 123, 0.16)),
        url('{{asset('images/donate.webp')}}') center/cover no-repeat;">
    
   <form class="form-card" method="POST" action="{{ route('RegisterAction') }}" style="min-width:340px; max-width:400px; background-color:rgba(0, 0, 0, 0.3); border-radius:40px; border:1px solid rgba(0,0,0,0.1);">
        @csrf
        <h2 class="text-center mb-4 text-primary">Sign Up</h2>
        <h5 class="text-center mb-4 text-primary">Join and support meaningful campaigns</h5>
       
        <div class="mb-2">
            <label class="form-label small fw-semibold">Username</label>
            <div class="input-group input-group-sm">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="use your real name"
                    required
                >
            </div>
            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

          <div class="mb-2">
            <label class="form-label small fw-semibold ">Email Address</label>
            <div class="input-group input-group-sm">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    name="email" 
                    placeholder="example@email.com"
                    value="{{ old('email') }}" 
                    required
                >
            </div>
            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-2">
            <label class="form-label small fw-semibold">Phone Number</label>
            <div class="input-group input-group-sm">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input 
                    type="tel" 
                    id="phone"
                    name="phone" 
                    class="form-control @error('phone') is-invalid @enderror"
                    placeholder="+961XXXXXXXX"
                    value="{{ old('phone') }}"
                    required
                >

            </div>
            @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-2">
        <label class="form-label small fw-semibold">Password</label>
        <div class="input-group input-group-sm">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input 
            type="password" 
            class="form-control @error('password') is-invalid @enderror" 
            name="password"
            required
        >
        </div>
        <small class="text-muted">
        Min 8 chars, include number & symbol.
       </small>
        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-2">
        <label class="form-label small fw-semibold">Confirm Password</label>
        <div class="input-group input-group-sm">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input 
        type="password" 
        class="form-control" 
        name="password_confirmation"
        placeholder="re-enter password"
        required
         >
        </div>

       
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="terms" id="terms" required>
            <label class="form-check-label" for="terms">I agree to <a href="#">terms of service</a></label>
            @error('terms')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">
            Create Account
        </button>

        <p class="mt-3 text-center text-muted">
            Already have an account? <a href="{{ route('LoginAction') }}">Sign in</a>
        </p>
    </form>
</main>
<script>

const phoneInput = document.getElementById('phone');
const countryCode = '+961';

phoneInput.addEventListener('focus', () => {
    if (phoneInput.value === '') {
        phoneInput.value = countryCode;
    }
});

phoneInput.addEventListener('input', () => {
    if (!phoneInput.value.startsWith(countryCode)) {
        phoneInput.value = countryCode;
    }

    let numbers = phoneInput.value.replace(countryCode, '').replace(/\D/g, '');
    numbers = numbers.substring(0, 8); 
    phoneInput.value = countryCode + numbers;
});
</script>
<style>

    .form-card {
    background-color: rgba(18, 18, 221, 0.78);
    padding: 30px;
    border-radius: 10px;
    max-width: 400px;
    width: 100%;
    color: rgba(226, 226, 232, 0.83);
    box-shadow: 0 6px 20px rgba(11, 1, 1, 0.5);
}
form-card input {
    background-color: rgb(240, 16, 38);
    border: 6px solid rgba(255,255,255,0.3);
    color: #fffefe;
}

.form-card input::placeholder {
    color: rgba(75, 72, 72, 0.9);
}

.form-card .btn-danger {
    background: linear-gradient(45deg, #e63946, #ff4b5c);
    border: none;
    font-weight: 800;
}
.form-card a {
    color: #694bff;
    text-decoration: none;
}
</style>
</x-layout>
