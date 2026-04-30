<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<section class="help-hero">
    <h1>How can we help?</h1>
    <p>Find answers, manage your fundraiser, and get support</p>

    <input type="text" placeholder="Search for help articles..." class="help-search">
</section>

<section class="help-categories container">
    <div class="help-card">
    <i class="bi bi-rocket-takeoff"></i>
    <h4>Getting Started</h4>
        <p>Create and launch your fundraiser</p>
    </div>

    <div class="help-card">
         <i class="bi bi-heart-fill"></i>
        <h4>Donations</h4>
        <p>How donations work & refunds</p>
    </div>

    <div class="help-card">
        <i class="bi bi-cash-stack"></i>
        <h4>Receiving Funds</h4>
        <p>Withdrawals & payment issues</p>
    </div>

    <div class="help-card">
        <i class="bi bi-shield-check"></i>
        <h4>Trust & Safety</h4>
        <p>Account security & fraud prevention</p>
    </div>
</section>

<section class="popular-questions container">
    <h2>Popular Questions</h2>

    <div class="question">
        <h3>How do I start a fundraiser?</h3>
        <p>Create an account, click “Create Campaign”, set your goal, and submit for approval.</p>
    </div>

    <div class="question">
        <h3>When can I withdraw funds?</h3>
        <p>Once your campaign is approved and donations are received, withdrawals are available.</p>
    </div>

    <div class="question">
        <h3>Is FundNest safe?</h3>
        <p>Yes. We use secure payments and admin verification to protect donors and organizers.</p>
    </div>
</section>

<section class="help-contact">
    <h3>Still need help?</h3>
    <p>Our support team is here for you</p>
    <a href="/contact"> Contact support </a>
</section>

 <div class="empty-actions">
                <a href="/" class="btn btn-primary">Back to Home</a>
            </div>


</x-layout>
<style>

.help-hero {
    text-align: center;
    padding: 80px 20px;
    background: ;
    color: white;
    background:linear-gradient(
        rgba(18, 18, 80, 0.85),
        rgba(60, 18, 120, 0.9)
    );
}

.help-hero h1 {
    font-size: 3rem;
    font-weight: 800;
}

.help-hero p {
    font-size: 1.2rem;
    margin-bottom: 25px;
}

.help-search {
    width: 60%;
    max-width: 500px;
    padding: 14px;
    border-radius: 10px;
    border: none;
    font-size: 1rem;
}

.help-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
    margin: 60px auto;
}

.help-card {
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    text-align: center;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: 0.3s;
    cursor: pointer;
}

.help-card:hover {
    transform: translateY(-6px);
}

.help-card img {
    width: 50px;
    margin-bottom: 15px;
}

.help-card h4 {
    font-weight: 700;
}

.popular-questions {
    margin-bottom: 80px;
}

.popular-questions h2 {
    font-weight: 800;
    margin-bottom: 30px;
}

.question {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 15px;
}

.question h5 {
    font-weight: 700;
}

.help-contact {
    text-align: center;
    padding: 60px 20px;
    background: #f1f1f1;
}

.help-card i {
    font-size: 2.8rem;
    color: #02a95c;
    margin-bottom: 15px;
}

.empty-actions {
    margin-top: 30px;
    display: flex;
    gap: 10px;
    justify-content: center;
}
</style>