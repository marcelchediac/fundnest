<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donate - {{ $campaign->title }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
    min-height: 100vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 40px 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc, #38ef7d, #11998e);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    position: relative;
    }

    @keyframes gradientBG {
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

    .donation-container {
      width: 100%;
      max-width: 600px;
    }

    .alert-box {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-radius: 15px;
      padding: 15px 20px;
      font-weight: 600;
      font-size: 1rem;
      margin-bottom: 25px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
      position: relative;
      animation: slideDown 0.5s ease;
    }

    .alert-success-custom {
      background: linear-gradient(135deg, #38ef7d, #11998e);
      color: #fff;
    }

    .alert-error-custom {
      background: linear-gradient(135deg, #f85032, #e73827);
      color: #fff;
    }

    .alert-box .alert-icon {
      font-size: 1.3rem;
      margin-right: 10px;
    }

    .alert-box .btn-close {
      filter: invert(1);
    }

    @keyframes slideDown {
      0% { transform: translateY(-20px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    .donation-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 60px 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    }

    .donation-card:hover {
      transform: translateY(-5px);
       box-shadow: 0 25px 60px rgba(0,0,0,0.35);
    }

    .donation-card h4 {
      font-weight: bold;
      margin-bottom: 10px;
      color:black;
      font-size: 1.8rem;
    }

    .donation-card p {
      color: #555;
      margin-bottom: 25px;
      font-size: 1rem;
    }


    .amount-btn {
      flex: 1;
      padding: 12px 0;
      border-radius: 12px;
      font-weight: bold;
      border:2px solid #fff;
      margin-bottom: 10px;
       transition: all 0.3s;
    }

    .amount-btn:hover {
      transform: scale(1.1);
      color: #fff;
      background: linear-gradient(135deg, #38ef7d, #11998e);
      border-color: transparent;
       box-shadow: 0 6px 20px rgba(0,0,0,0.35);
    }

    .custom-amount {
      margin-bottom: 15px;
      border-radius: 12px;
      padding: 12px;
    }

    .form-check-label {
      color: #555;
    }

    .btn-success {
      font-weight: bold;
      font-size: 1.1rem;
      border-radius: 12px;
      padding: 12px;
      background: linear-gradient(135deg, #38ef7d, #11998e);
      border: none;
      transition: transform 0.2s, box-shadow 0.3s;
    }

    .btn-success:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }

    @media (max-width: 576px) {
      .amount-btn {
        font-size: 0.9rem;
      }
      .donation-card {
        padding: 40px 20px;
      }
}

    .floating-shape {
    position: absolute;
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
    z-index: 0;
}

@keyframes float {
    0%,100% { transform: translateY(0);}
    50% { transform: translateY(-20px);}
}

.btn-secondary[disabled] {
    cursor: not-allowed;
    opacity: 0.6;
}
  </style>
</head>
<body>
<div class="floating-shape" style="top:10%; left:5%;"></div>
<div class="floating-shape" style="top:50%; left:80%;"></div>

  <div class="donation-container">

    @if(session('success'))
      <div class="alert-box alert-success-custom d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
              <span class="alert-icon">✔</span>
              <span>{{ session('success') }}</span>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('error'))
      <div class="alert-box alert-error-custom d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
              <span class="alert-icon">✖</span>
              <span>{{ session('error') }}</span>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="donation-card">
      <h4>You're supporting "{{ $campaign->title }}"</h4>
      <p>Your donation will benefit {{ $campaign->user->name }}.</p>
      <form method="POST" action="{{ route('donations.store', $campaign) }}">
        @csrf

        <div class="d-flex gap-2 mb-2">
          <button type="button" class="btn btn-outline-success amount-btn" data-amount="25">$25</button>
          <button type="button" class="btn btn-outline-success amount-btn" data-amount="50">$50</button>
          <button type="button" class="btn btn-outline-success amount-btn" data-amount="100">$100</button>
        </div>

        <div class="d-flex gap-2 mb-3">
          <button type="button" class="btn btn-outline-success amount-btn" data-amount="150">$150</button>
          <button type="button" class="btn btn-outline-success amount-btn" data-amount="200">$200</button>
          <button type="button" class="btn btn-outline-success amount-btn" data-amount="500">$500</button>
        </div>

        <input type="number" name="amount" id="amount" class="form-control custom-amount" placeholder="Custom amount" min="1" required>

        <div class="form-check mb-3">
          <input type="checkbox" name="anonymous" class="form-check-input" id="anonymous" value='1'>
          <label class="form-check-label" for="anonymous">Donate anonymously</label>
        </div>

        <button type="submit" class="btn btn-success w-100">Donate Now</button>
      </form>
    </div>

  </div>
  <script>
    const buttons = document.querySelectorAll('.amount-btn');
    const amountInput = document.getElementById('amount');

    buttons.forEach(button => {
      button.addEventListener('click', () => {
        amountInput.value = button.dataset.amount;
      });
    });

    @if(session('success'))
    setTimeout(() => {
        window.location.href = "{{ route('home') }}";
    }, 2500);
@endif
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>