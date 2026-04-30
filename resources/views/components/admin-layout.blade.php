<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - FundNest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="admin-body">

<nav class="admin-navbar">
    <div class="admin-brand">
        FundNest <span>Admin</span>
    </div>

    <div class="admin-links">
        <a href="{{ route('admin.campaigns') }}">Dashboard</a>
        <a href="{{ route('home') }}" target="_blank">View Site</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>
</nav>

<main class="admin-content">
    {{ $slot }}
</main>

<style>
body, html {
    margin:0; padding:0;
    font-family: 'Inter', sans-serif;
    background: linear-gradient(rgba(83, 111, 238, 0.64),rgba(61, 10, 190, 0.16));
    color: #fff;
    min-height: 100vh;
}

.admin-navbar {
    height: 60px;
    background:#1b1c2e;
    color: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    position: sticky;
    top: 0;
    z-index: 999;
      border-bottom: 1px solid #1d2cd2;
}

.admin-brand {
    font-size: 22px;
    font-weight: 800;
    color: #f5d042;
}

.admin-brand span {
    color: #38ef7d;
}

.admin-links {
    display: flex;
    align-items: center;
    gap: 20px;
}

.admin-links a {
    color: #cbd5f5;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s;
}

.admin-links a:hover {
    color: #38ef7d;
}

.admin-content {
    padding: 30px 40px;
}

body::before {
    content:"";
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle at center, #f5d042, transparent);
    top: -100px;
    left: -150px;
    filter: blur(200px);
    opacity: 0.2;
    z-index:0;
}

body::after {
    content:"";
    position: absolute;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle at center, #38ef7d, transparent);
    bottom: -50px;
    right: -100px;
    filter: blur(150px);
    opacity: 0.2;
    z-index:0;
}

.admin-content > * {
    position: relative;
    z-index: 1; /* content above floating shapes */
}
</style>

</body>
</html>