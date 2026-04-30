<div class="about-page">

    <header class="about-hero">
        <div class="shape circle"></div>
        <div class="shape triangle"></div>
        <div class="shape dot"></div>

        <div class="hero-content">
        <h1>About <span>FundNest</span></h1>
        <p>Where support meets impact.</p>
        <p class="hero-text">
            FundNest is a crowdfunding platform that helps people create campaigns,
            receive donations, and support meaningful causes with trust and transparency.
        </p>

        <div class="hero-buttons">
            <a href="/campaigns/create" class="btn primary"> Start a Campaign </a>
            <a href="/" class="btn secondary"> Explore Camapigns </a>
</div>

    </header>


    <section class="mission-card">
        <h2>Our Mission</h2>
        <p> At FundNest, our mission is to make fundraising <strong> simple</strong>,<strong> transparent</strong>, and <strong> impactful </strong>.</p>
           <p> We connect donors with campaign creators so every cause gets a chance to grow
            and every contribution can create real change. </p>
            <div class="mission-points">
                <span> 💡 Simple </span>
                <span> 🔍 Transparent </span>
                <span> 🌍 Impactful </span>
    </section>


    <section class="features">
        <div class="feature-card red">
            <div class="icon">📝</div>
            <h3>Create Campaigns</h3>
            <p>Start a campaign with a clear goal, story, and funding target.</p>
        </div>

        <div class="feature-card green">
            <div class="icon">💰</div>
            <h3>Make Donations</h3>
            <p>Support causes safely and easily through secure donations.</p>
        </div>

        <div class="feature-card blue">
            <div class="icon">📊</div>
            <h3>Track Progress</h3>
            <p>Follow campaign progress, milestones, and funding updates in real time.</p>
        </div>
    </section>

     <section class="impact-section">
        <h2> Our Impact </h2>

        <div class="impact-grid">

        <div class="impact-item">
            <h3> Empowering Communities </h3>
            <p> Helping people turn ideas into meaningful causes. </p>
</div>

            <div class="impact-item">
            <h3> Supporting Donations </h3>
            <p> Making it easy to give and support securely </p>
</div>

            <div class="impact-item">
            <h3> Building Trust</h3>
            <p> Ensuring transparency between donors and creators</p>
</div>
</div>

<p class="impact-footer">
    Together, FundNest helps communities turn kindness into action.
</p>
</section>

    <section class="trust-section">
        <h2>Trust & Security</h2>
        <p>
            FundNest prioritizes secure transactions, transparent campaign progress,
            and accountable fundraising. Our platform is designed to protect both donors
            and campaign creators.
        </p>

        <div class="trust-icons">
            <div class="trust-item">
                <span>  🔒 </span>
                <p> Secure Payments </p>
            </div>
             <div class="trust-item">
                <span>  🛡️ </span>
                <p> Verified Campaigns </p>
            </div>
             <div class="trust-item">
                <span>  📊 </span>
                <p> Full Transparency</p>
            </div>
</div>
    </section>

   <section class="join-section">
        <h2>Join the <span>FundNest</span> Community</h2>
        <p>
            Whether you are starting a campaign or supporting one, FundNest gives you
            the power to make a meaningful impact.
        </p>
        
        <a href="/campaigns/create" class="cta-btn "> Start a Campaign </a>
    </section>

</div>

<style>

    body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background: #f8fafc;
}
.about-page {
    max-width: 1180px;
    margin: auto;
    padding: 50px 20px;
}

.about-hero {
    position: relative;
    text-align: center;
    padding: 90px 20px 70px;
    overflow: hidden;
    background: linear-gradient(135deg, #eef5ff, #f8fbff);
}

.hero-content{
    max-width:750px;
    margin:auto;
    padding: 40px 50px;
     background: linear-gradient(370deg, #ffffff, #eef6ff);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
    text-align:center;
}

.hero-content h1{
    color: #111827;
    font-size:2.6rem;
    font-weight:800;
    margin-bottom:12px;
}

.hero-content h1 span{
    color:#3b83f6;
}

.hero-content .subtitle{
    color: #2563eb;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 18px;
}

.hero-content p:first-of-type {
    font-size:1.15rem;
    font-weight:500;
    color: #4b5563;
    margin-bottom: 18px;
}

.hero-text{
    max-width:620px;
    margin:0 auto;
    color: #374151;
    font-size: 1.05rem;
    line-height: 1.7;
}

.hero-buttons{
    margin-top: 25px;
}

.btn{
    display: inline-block;
    padding:12px 22px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 700;
    margin: 0 8px;
    transition: 0.3s ease;
}

.btn.primary{
    background: transparent;
    color: #3b83f6;
   border: 2px solid #3b82f6;
}

.btn.primary:hover{
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0,15);
}

.btn.secondary{
    background: transparent;
    color: #3b83f6;
    border: 2px solid #3b82f6;
}

.btn.secondary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0,0,0,0,15);

}

.hero-text {
    max-width: 750px;
    margin: 18px auto 0;
    line-height: 1.9;
    font-size: 1.1rem;
    color: #374151;
    font-weight: 400;
}

.shape {
    position: absolute;
    opacity: 0.05;
    animation: float 5s ease-in-out infinite alternate;
}

.circle {
    width: 120px;
    height: 120px;
    background: #3b82f6;
    border-radius: 50%;
    left: 10%;
    top: 30px;
}

.triangle {
    width: 0;
    height: 0;
    border-left: 55px solid transparent;
    border-right: 55px solid transparent;
    border-bottom: 90px solid #f97316;
    right: 10%;
    top: 50px;
}

.dot {
    width: 22px;
    height: 22px;
    background: #10b981;
    border-radius: 50%;
    left: 52%;
    top: 55px;
}

@keyframes float {
    from {
        transform: translateY(0);
    }
    to {
        transform: translateY(-18px);
    }
}

.mission-card {
    background: linear-gradient(120deg, #036161b1, #60a5fa);
    color: white;
    magrin-bottom: 70px;
    opacity: 0.95;
    padding: 80px 40px;
    border-radius:20px;
    margin-bottom:40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    text-align: center;

}
.mission-card p{
    max-width:650px;
    margin: 10px auto;
    line-height: 1.6;
    color: rgba(255,255,255,0.95);
}

.mission-card h2{
    font-size: 2.6rem;
    margin-bottom: 20px;
}


.mission-section strong{
    color:#ffffff;
    font-weight: 700;
}
.mission-points{
    display:flex;
    justify-content: center;
    gap: 25px;
    margin-top: 25px;
    flex-wrap: wrap;
    font-size:18px;
}

.mission-points span{
    font-weight: 600;
    opacity: 0.9;
    transition: all 0.2s ease;
}

.mission-points span:hover{
    transform: translateY(-3px);
    opacity:1;
}

.impact-section{
    background: linear-gradient(135deg, #1e293b, #0f172a);
    text-align:center;
    padding: 20px 30px;
    margin-bottom: 40px;
    color: white;
    box-shadow:0 20px 60px rgba(0,0,0,0.15);
    margin-top: 60px;
    border-radius:22px;
}
.impact-section h2{
    width:100%;
    text-align:center;
    margin-bottom: 30px;
    font-size:2rem;
}

.impact-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    margin-bottom: 40px;
    margin: auto ;
    justify-content: space-between;
    align-items: flex-start;
    
}

.impact-item{
    flex:1;
    display:flex;
    flex-direction: column;
    align-items:center;
    min-width: 180px;
    transition: transform 0.3s ease;
    padding: 20px;
    border-radius: 16px;
}

.impact-item:hover{
    transform: translateY(-6px);
}

.impact-item h3{
    min-height:60px;
    font-size: 28px;
    font-weight: 600;
    text-shadow: 0 4px 20px rgba(255,255,255,0.3);
    letter-spacing:1px;
    margin-bottom: 10px;
}


.impact-item p{
    margin-top:0;
   color: rgba(255,255,255,0.9);
   font-size: 16px;
}

.impact-footer {
    margin-top: 40px;
    font-weight: 500;
    font-size: 1.1rem;
    color: rgba(255,255,255,0.9);
}

.trust-section {
    background: linear-gradient(330deg, #02030cb4, #3b82f6);
    text-align: center;
    padding: 60px 40px;
    border-radius:22px;
    margin-bottom: 40px;
    color:white;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.trust-section h2{
    font-size: 2.2rem;
    margin-bottom: 20px;
    font-weight: 700;

}

.trust-section p{
    max-width:780px;
    margin: 0 auto;
    font-size: 1.05rem;
    line-height: 1.6;
}
.trust-section:hover{
    transform: translateY(-3px);
    transition: 0.3s ease;
}

.trust-icons{
    display:flex;
    justify-content: center;
    gap: 40px;
    margin-top: 20px;
    flex-wrap: warap;
}

.trust-item{
    transition: 0.3s;
}

.trust-item:hover{
    transform: translateY(-5px);
}

.trust-item span{
    font-size: 30px;
    display:block;
    margin-bottom: 10px;
}

.trust-item p{
    font-size: 0.95rem;
    color:rgba(255,255,255,0.9);
}


.join-section {
     background: linear-gradient(135deg, #6366f1, #8b5cf6);
    text-align: center;
    padding: 60px 40px;
    border-radius:22px;
    margin-bottom: 40px;
    color:white;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.join-section:hover{
    transform: translateY(-3px);
    transition: 0.3s ease;
}

.join-section h2{
     font-size: 2.2rem;
    margin-bottom: 20px;
    font-weight: 700;
}

.join-section p{
     max-width:780px;
    margin: 0 auto;
    font-size: 1.05rem;
    line-height: 1.6;
}

.cta-btn{
    display: inline-block;
    margin-top: 25px;
    padding: 14px 34px;
    border-radius: 30px;
    border: 2px solid white;
    background: transparent;
    color: white;
    font-weight: 700;
    text-decoration:none;
    transition: 0.3s ease;
}

.cta-btn:hover{
    background:white;
    color: #4f46e5;
    transform: translateY(-3px);
}

.features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-bottom: 40px;
}

.feature-card {
    padding: 25px;
    border-radius: 16px;
    text-align: center;
    color: white;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08),
    transition: 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

.feature-card .icon {
    font-size: 2.2rem;
    margin-bottom: 10px;
    color:white;
}

.feature-card h3 {
    margin-bottom: 12px;
    font-weight: 600;
    color: black;
}

.feature-card p {
    font-size: 1.05rem;
    line-height: 1.7;
    opacity: 0.9;
    color:black;
}

@media (max-width: 900px) {
    .features {
        grid-template-columns: 1fr;
    }

    .about-hero h1 {
        font-size: 2.4rem;
    }

}

</style>