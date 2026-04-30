<nav class="contact-navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="brand-name">FundNest</a>

        <div class="nav-actions">
            <a href="{{ route('Helpcenter') }}" class="back-btn">← Back to Help Center</a>
        </div>
    </div>
</nav>
{{$slot}}

<style>
.contact-navbar {
    background-color: #2a3f54;
    padding: 15px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.contact-navbar .brand-name {
    color: #fff;
    font-weight: 700;
    font-size: 22px;
    text-decoration: none;
}

.contact-navbar .nav-actions .back-btn {
    color: #f0f0f0;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid #fff;
    padding: 1px 3px;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.contact-navbar .nav-actions .back-btn:hover {
    background-color: #fff;
    color: #2a3f54;
}
</style>
