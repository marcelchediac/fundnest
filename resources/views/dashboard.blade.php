<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

@foreach($campaigns as $campaign)
@if($campaign->document_requested && $campaign->documents->isEmpty())
<div class="document-alert">
    <strong> Admin requested documents for
    {{$campaign->title}}</strong>
        <p> Please upload supporting documents to continue approval.</p>
    <a href="{{route('campaign.documents.upload',$campaign)}}" class="upload-btn">
        Upload Now
</a>

</div> 
    @endif
    @endforeach 
 
    @if(session('success'))
    <div class=" alert-success ">
        {{ session('success') }}
    </div>
@endif

<main class="dashboard-bg">

    <div class="container dashboard-container">

        <h2 class="dashboard-title">Welcome, {{ auth()->user()->name }}!</h2>
        <p class="dashboard-subtitle">What would you like to do today?</p>

        <div class="row justify-content-center g-4">

            <div class="col-md-4">
                <div class="card dashboard-card shadow-sm h-100 text-center">
                    <div class="dashboard-icon text-primary">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h4 class="card-title mb-3">Create a Campaign</h4>
                    <p class="card-text text-muted">
                        Start your own fundraising case and share it with others.
                    </p>
                    <a href="{{ route('campaign.create') }}" class="btn btn-primary w-100 mt-3">Create Campaign</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard-card shadow-sm h-100 text-center">
                    <div class="dashboard-icon text-danger">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h4 class="card-title mb-3">Donate</h4>
                    <p class="card-text text-muted">
                        Support an existing campaign. You can donate anonymously or with your name.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-success w-100 mt-3">Donate Now</a>
                </div>
            </div>

        </div>
    </div>

</main>
 <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-bg {
            min-height: 100vh;
            background: linear-gradient(rgba(18,18,221,0.6), rgba(71,18,123,0.4)),
             url('{{ asset("images/dashboard img.avif") }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .document-alert{
            padding: 3px;
            margin:auto;
            background: linear-gradient(rgba(10, 10, 237, 0.6), rgba(65, 9, 121, 1.4));
            text-align:left;
        }
        .document-alert strong{
            font-size:18px;
            margin-left:12px;
            color: white;
        }
        .document-alert p{
            font-size:16px;
            margin: 10px;
            opacity: 0.9;
            color: white;
        }
        .upload-btn{
            display: inline-block;
            padding: 10px 17px;
            border-radius: 8px;
            background: linear-gradient(135deg, #7047d7, #3b82f6);
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            margin-left: 100px;
            color:white;
            margin-bottom:5px;
            margin-top:5px;
        }
        .upload-btn:hover{
            transform: translateY(-2px);
            opacity: 0.9;
        }


        .alert-success{
            padding:12px 20px ;
            border-radius: 12px;
            font-weight: 600;
            background: linear-gradient(rgba(36, 9, 94, 0.7), rgba(71,18,123,0.4));
            backdrop-filter: blur(8px);
            color:white;
            text-align:left;
        }

        .dashboard-container {
            text-align: center;
            max-width: 1200px;
            width: 100%;
            padding: 30px;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fff;
        }

        .dashboard-subtitle {
            color: #f0f0f0;
            margin-bottom: 50px;
            font-size: 1.1rem;
        }

        .dashboard-card {
            background-color: rgba(255,255,255,0.95);
            border-radius: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            padding: 30px;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .dashboard-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .btn-primary, .btn-success {
            font-weight: bold;
        }
    </style>

<script>

    setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert=> {
        alert.style.display = 'none';
    });
    
}, 3000);

src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"

</script>

</body>
</html>