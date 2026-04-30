
<nav class="navbar home-navbar">
    <div class="container-fluid position-relative d-flex justify-content-between align-items-center">
    
        <div class="navbar-center mx-auto">
            <a href="{{ route('home') }}" class="brand-name">FundNest</a>
        </div>

        <button class="burger-btn" onclick="toggleMenu()">☰</button>
    </div>
</nav>
<div id="sideMenu" class="side-menu">
    <button class="close-btn" onclick="toggleMenu()">×</button>

    <div class="menu-actions mt-4">
        <a href="{{ route('RegisterAction') }}" class="btn start-btn mb-2">
            Start a GoFundMe
        </a>

        <a href="{{ route('LoginAction') }}" class="btn login-btn">
            Sign In
        </a>

        <a href="{{ route('Helpcenter') }}" class="btn Helpcenter-btn  mb-2">
            Help Center
        </a>
    </div>
</div>

<main class="home-hero">
    <section class="hero">
        <h1>Successful fundraisers start here</h1>
        <p class="hero-sub">
            Fundraising made simple, secure, and impactful.
        </p>

        @guest
            <a href="{{ route('Register') }}" class="cta-btn">Start a FundMe</a>
        @else
            <a href="{{ route('campaign.create') }}" class="cta-btn">Start a FundMe</a>
        @endguest
    </section>
    <section class="trust">

        <p class="no-fee">No platform fee to start fundraising</p>
</section>

    <section class="steps">
        <div class="step-card">
            <h3>1️⃣ Use our tools to create fundraisers</h3>
            <p>You’ll be guided step-by-step to set up your campaign.</p>
        </div>

        <div class="step-card">
            <h3>2️⃣ Reach donors by sharing</h3>
            <p>Share your fundraiser with friends, family, and social media.</p>
        </div>

        <div class="step-card">
            <h3>3️⃣ Securely receive funds</h3>
            <p>Withdraw donations safely and transparently.</p>
        </div>
    </section>
   
<section class="public-campaigns">

    <h2 class="section-title">Active Fundraisers</h2>

    <div class="campaign-grid">
        @foreach($campaigns as $campaign)
        @php
    $percent = ($campaign->collected_amount / max($campaign->goal_amount,1)) * 100;
     $isCompleted = $campaign->status === 'completed';

    if ($isCompleted || $percent>=100) {
        $progressClass = 'progress-complete';
        $percent=100;
    } 
    elseif ($percent==0){
         $progressClass = 'progress-empty';
}
        elseif ($percent < 30) {
        $progressClass = 'progress-low';
    } elseif ($percent < 70) {
        $progressClass = 'progress-mid';
    } elseif ($percent < 100) {
        $progressClass = 'progress-high';
    } 
@endphp
           <div class="public-card" data-url="{{ route('campaign.show', $campaign->id) }}">
            @if(isset($favoriteCategoryId) && $campaign->category_id == $favoriteCategoryId)
        <div class="recommended-badge">Recommended</div>
    @endif
    
                @if($campaign->video_url)
              <iframe width="100%" height="200"
                 style="border-radius:40px;"
                src="{{ str_replace('watch?v=', 'embed/', $campaign->video_url) }}"
                      frameborder="0"
                        allowfullscreen>
                   </iframe>
                   @endif

                <img 
                    src="{{ $campaign->image ? asset('storage/'.$campaign->image) : asset('images/default-campaign.jpg') }}"
                    class="public-img"
                    alt="{{ $campaign->title }}"
                >
    
                <div class="card-body">
                    <h3>{{ $campaign->title }}</h3>

                    <p class="desc">
                        {{ Str::limit($campaign->description, 500) }}
                    </p>

                    <div class="progress-box">
                        @php
                            $percent = ($campaign->collected_amount / max($campaign->goal_amount,1)) * 100;
                        @endphp

                       <div class="progress-track" style="position: relative;">
                      <div class="progress-fill {{ $progressClass }}" style="width: {{ min($percent, 100) }}%;"></div>
                              @if($isCompleted)
                           <span class="completed-text">✔</span>
                      @endif
                                   </div>

                        <div class="amounts">
                            <span>
                                <strong>${{ number_format($campaign->collected_amount, 0) }}</strong> raised
                            </span>
                            <span>
                                of ${{ number_format($campaign->goal_amount, 0) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="btn-case">View case</div>
            </div>
            
        @endforeach
    </div>

</section>

</main>
<script>
    function toggleMenu() {
        const sideMenu = document.getElementById('sideMenu');
        sideMenu.classList.toggle('open');
    }

     document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.public-card');
        cards.forEach(card => {
            const url = card.getAttribute('data-url');
            card.style.cursor = 'pointer'; 
            card.addEventListener('click', () => {
                window.location.href = url;
            });
        });
});
</script>

<style>
.home-hero {
    min-height: 100vh;
    background: linear-gradient(
        rgba(20, 20, 60, 0.85),
        rgba(40, 20, 90, 0.9)
    ),
    url('/images/donate.webp') center/cover no-repeat;
    color: #fff;
    padding: 80px 20px;
}

.hero {
    text-align: center;
    max-width: 800px;
    margin: auto;
}


.hero h1 {
    font-size: 52px;
    font-weight: 800;
    margin-bottom: 15px;
}

.hero-sub {
    font-size: 20px;
    opacity: 0.9;
    margin-bottom: 30px;
}

.cta-btn {
    display: inline-block;
    padding: 15px 40px;
    font-size: 20px;
    border-radius: 50px;
    background: linear-gradient(90deg, #38ef7d, #11998e);
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    transition: transform 0.2s ease;
}

.cta-btn:hover {
    transform: translateY(-3px);
}

.trust {
    text-align: center;
    margin: 80px 0 40px;
}

.trust h2 {
    font-size: 28px;
}

.trust span {
    color: #38ef7d;
    font-weight: 800;
}

.no-fee {
    margin-top: 10px;
    font-size: 18px;
    opacity: 0.9;
}

.steps {
    display: flex;
    gap: 30px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 60px;
}

.step-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    width: 280px;
    text-align: center;
}

.step-card h3 {
    font-size: 20px;
    margin-bottom: 10px;
}

.step-card p {
    opacity: 0.9;
}

.public-campaigns {
    padding: 80px 20px;
    margin-top: 60px;
    border-top: 4px solid rgba(255,255,255,0.15);
}

.section-title {
    text-align: center;
    font-size: 34px;
    font-weight: 800;
    margin-bottom: 50px;
    color: #fff;
}

.recommended-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #38ef7d;
    color: #fff;
    font-weight: 700;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 12px;
    z-index: 10;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.public-card {
    position: relative; 
}

.campaign-grid {
   display: flex;
    gap: 30px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 30px;
    
}

.public-card {
  border-radius: 70px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    backdrop-filter: blur(10px);
    padding: 30px;
    width: 300px;
    text-align: center;
    background: rgba(27, 16, 149, 0.21);
    transition: transform 0.25s ease;
}

.public-card:hover {
    transform: translateY(-6px);
}

.public-img {
    width: 60%;
    height: 150px;
    margin-top:20px;
    object-fit: cover;
    border-radius:15px;
}

.card-body {
    padding: 20px;
}

.card-body h3 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #e7e4e4;
}

.desc {
    font-size: 17px;
    color: #f3ebeb;
    margin-bottom: 18px;
    
}

.progress-box {
    margin-top: 10px;
}

.progress-track {
   height: 10px;
    background: #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
}

.progress-fill {
   height: 100%;
   border-radius: 10px;
   transition: width 0.6s ease, background-color 0.4s ease;
}

.amounts {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    margin-top: 8px;
    color: #e49e13;
}
.progress-empty {
    background: #bdbdbd;
}

.progress-low {
    background: linear-gradient(90deg, #f7b733, #fc4a1a); 
}

.progress-mid {
    background: linear-gradient(90deg, #38ef7d, #11998e); 
}

.progress-high {
    background: linear-gradient(90deg, #1faa59, #0b8457); 
}

.progress-complete {
    background: linear-gradient(90deg, #0f9b0f, #1f4803e6); 
}
.completed-text {
    position: absolute;
    top: 50%;
    left: 95%;
    transform: translate(-50%, -50%);
    font-size: 0.85rem;
    font-weight: bold;
    color: #edf5f4;
    pointer-events: none;
}

.home-navbar {
    background: #1939f1d6;
    display:flex;
    align-items: center;
    padding: 20px 20px;
    position: relative;
}

.navbar-center {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.brand-name {
     font-family: 'Poppins', sans-serif;
    font-size: 35px;
    font-weight: 900;
    color: #ffffff;
    background: linear-gradient(90deg, #38ef7d, #11998e);
    -webkit-text-fill-color: transparent; 
    -webkit-background-clip:text;
    text-decoration: none;
     padding: 20px 20px;                        
}
.btn-case{
    display:inline-block;
    font-family: 'Poppins', sans-serif;
    padding:12px 25px;
    font-size:14px;
    font-weight:700;
    border-radius:15px;
    text-decoration:none;
    background: linear-gradient(135deg, #38ef7d, #11998e);
    color:#fff;
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}
.btn-case:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    background: linear-gradient(135deg, #11998e, #38ef7d);
}

.burger-btn {
     font-size: 20px;
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
    padding: 8px 12px;

}


.side-menu {
    position: fixed;
    top: 0;
    right: -340px;
    width: 200px;
    height: 100%;
    background:  #1939f137;
    box-shadow: -4px 0 20px rgba(16, 13, 13, 0.36);
    padding: 30px;
    transition: right 0.3s ease;
    z-index: 3000;
    overflow-y: auto;
}

.side-menu.open {
    right: 0;
}
.close-btn {
    font-size: 28px;
    background: none;
    border: none;
    cursor: pointer;
    display: block;
    margin-left: auto;
}

.menu-title {
    font-size: 30px;
    font-weight: 800;
    margin: 20px 0 10px;
}

.menu-actions .btn {
    width: 100%;
    font-weight: 800;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
}

.start-btn {
    background: linear-gradient(90deg, #3615cb, #11998e);
    color: #fff;
    display: block;
    text-decoration:none;
    font-size:18px;
}

.login-btn {
    background:linear-gradient(90deg, #3615cb, #11998e);
    color: #fff;
    display: block;
    text-decoration:none;
    margin-top:20px;
    font-size:18px;
}
.Helpcenter-btn{
     background:linear-gradient(90deg, #3615cb, #11998e);
    color: #fff;
    display: block;
    text-decoration:none;
    margin-top:20px;
    font-size:18px;
}

.login-btn:hover, .start-btn,.Helpcenter-btn:hover {
    opacity: 0.9;
}

.btn-donate {
    display: inline-block;
    padding: 12px 25px;
    font-size: 15px;
    font-weight: 700;
    border-radius: 10px;
    text-decoration: none;
    color: #fff;
    background: linear-gradient(135deg, #38ef7d, #11998e);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.btn-donate:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(31, 8, 91, 0.78);
    background: linear-gradient(135deg, #11998e, #38ef7d);
    color: #fff;
}

.btn-donate:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(56, 239, 125, 0.4);
}
</style>
