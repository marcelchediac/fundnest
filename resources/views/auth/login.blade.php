
<x-layout>
@if(session('success'))
    <div class="alert-success-box">
      <i class="bi bi-check-circle-fill me-2"></i>
      {{ session('success') }}
    </div>
         @endif
         
      <main class="d-flex w-100 align-items-center justify-content-center "
        style="min-height:100vh;
        background:linear-gradient(rgba(18, 18, 221, 0.78),rgba(71, 18, 123, 0.16)),
        url('{{asset('images/donate.webp')}}') center/cover no-repeat;">

      <form class="form-card" method="post" action="{{route('LoginAction')}} "style="min-width:340px; max-width:400px; background-color:rgba(0, 0, 0, 0.3); border-radius:30px; border:1px solid rgba(0,0,0,0.1);">
        @csrf
        <h1 class="mb-4 text-center text-primary">Sign In</h1>

        @if(session('error'))
            <div class="alert-error-box mb-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"
            >Email address</label>
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            name="email"
          />
          <div id="emailHelp" class="form-text">
            We'll never share your email with anyone else.
          </div>
           @error('email')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            name="password"
          />
            @error('password')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1"
            >Remember me</label
          >
        </div>
        <h6 style="color: gray; font-size: 0.85rem">
          Don't have an account? <a href="{{route('RegisterAction')}}"> Sign up</a>
        </h6>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</main>

  <style>

.alert-success-box {
    display: flex;
    align-items: center;
    background: linear-gradient(90deg, #7238ef, #11998e);
    color: #fff;
    padding:  0.75rem 1.25rem ;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    font-weight: 500;
    animation: slideFade 0.6s ease;
}

.alert-success-box i {
    font-size: 1.2rem;
}

@keyframes slideFade {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}

.form-card {
    background-color: rgba(18, 18, 167, 0.57);
    padding: 30px;
    border-radius: 10px;
    max-width: 400px;
    color:rgba(226, 226, 232, 0.83);
    width: 100%;
    box-shadow: 0 6px 20px rgba(11, 1, 1, 0.5);
}

.form-card a {
    color: #694bff;
    font-size:16px;
    text-decoration:none;
}

.alert-error-box {
    display: flex;
    align-items: center;
    background: linear-gradient(90deg, #ff416c, #ff4b2b);
    color: #fff;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    font-weight: 500;
    animation: slideFade 0.6s ease;
}
.alert-error-box i {
    font-size: 1.2rem;
}

@keyframes slideFade {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}
</style>
</x-layout>
