<x-admin-layout>

@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert error">{{ session('error') }}</div>
@endif


 <div class="shape1"></div>
<div class="shape2"></div>

<main style=" min-width:100%;background: linear-gradient(135deg, #120cdd 0%, #47127b 100%); padding:70px 20px;">

    <div class="dashboard">

        <header class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <h4>Welcome back, {{ auth()->user()->name }}!</h4>
            <form method="GET" action="{{ route('admin.campaigns') }}" class="filter-form">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <select name="filter" onchange="this.form.submit()" class="filter-box">

            <option value="">Filter by Date</option>
            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Last Week</option>
            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Last Month</option>
            <option value="6months" {{ request('filter') == '6months' ? 'selected' : '' }}>Last 6 Months</option>
            <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>Last Year</option>

            </select>

</form>
            </header>

        <section class="stats">
                <a href="{{ route('admin.campaigns.status','pending') }} "class="stat-card gold">
                <span>Pending</span>
                <h2>{{ $stats['pending'] }}</h2>
</a>
                <a href="{{ route('admin.campaigns.status','approved') }}" class="stat-card teal">
                <span>Approved</span>
                <h2>{{ $stats['approved'] }}</h2>
</a>            
        <a href="{{ route('admin.campaigns.status','rejected') }}" class="stat-card violet">
                <span>Rejected</span>
                <h2>{{ $stats['rejected'] }}</h2>
</a>
            <a href="{{ route('admin.campaigns.status','completed') }}" class="stat-card blue">
                <span>Completed</span>
                <h2>{{ $stats['completed'] }}</h2>
</a>
            <div class="stat-card orange">
                <span>Total Raised</span>
                <h2>${{ number_format($stats['raised'], 0) }}</h2>
            </div>
        </section>

        @if($campaigns->count() === 0)
            <div class="empty-state">
                <h2>All caught up!</h2>
                <p>No campaigns waiting for approval.</p>
                <a href="{{ route('home') }}" class="btn">Go to Home</a>
            </div>
        @else
            <section class="campaigns">
                @foreach($campaigns as $campaign)
                    <div class="campaign-card">
                        <div class="card-header">
                            <div>
                                <strong>{{ $campaign->user->name }}</strong>
                                <span>{{ $campaign->created_at->format('M d, Y') }}</span>
                            </div>
                            <span class="status {{ $campaign->status }}">{{ ucfirst($campaign->status) }}</span>
                        </div>

                        @if($campaign->video_url)
                            <iframe src="{{ str_replace('watch?v=', 'embed/', $campaign->video_url) }}" 
                                    frameborder="0" allowfullscreen class="campaign-video"></iframe>
                        @endif

                        <img src="{{ $campaign->image ? asset('storage/'.$campaign->image) : asset('images/default-campaign.jpg') }}" 
                             alt="{{ $campaign->title }}" class="campaign-img">

                        <h3>{{ $campaign->title }}</h3>
                        <p>{{ Str::limit($campaign->description,600) }}</p>

                       @if($campaign->documents->count() > 0)

    <button type="button" class="view-doc-btn" onclick="toggleDocs({{ $campaign->id }})">
        View Document
    </button>

    <div id="docs-{{ $campaign->id }}" style="display:none; margin-top:10px;">
        @foreach($campaign->documents as $doc)
            <div>
                <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank">
                    {{ $doc->file_name }}
                </a>
            </div>
        @endforeach
    </div>

@else
    <p class="no-doc">No document uploaded</p>
@endif

                        <div class="goal-bar">
                            <span>Goal: ${{ number_format($campaign->goal_amount,2) }}</span>
                            <div class="progress-bar">
                                <div class="progress" style="width: {{ ($campaign->collected_amount / max($campaign->goal_amount,1)) * 100 }}%"></div>
                            </div>
                        </div>

                        @if($campaign->ai_summary)

                          <div class="ai-box">

                            <h4>🤖 AI Review</h4>

                            <p><strong>Summary:</strong> {{ $campaign->ai_summary }}</p>

                            <p><strong>Risk Level:</strong> 
                            <span class="risk {{ $campaign->ai_risk }}">
                             {{ ucfirst($campaign->ai_risk) }}</span></p>

                            <p><strong>Recommendation:</strong> {{ $campaign->ai_recommendation }}</p>

                            </div>
                                @endif

                        @if($campaign->status == 'pending')
                        <div class="actions">
                            <form method="POST" action="{{ route('admin.campaigns.approve', $campaign) }}">
                                @csrf
                                <button class="approve">Approve</button>
                            </form>

                            <form method="POST" action="{{ route('admin.campaigns.reject', $campaign) }}">
                                @csrf
                                <button class="reject">Reject</button>
                            </form>

                            @if($campaign->documents->isEmpty())
                                <form method="POST" action="{{route('admin.campaigns.requestDocuments',$campaign)}}">
                                    @csrf 
                                    <button class="request"> Request </button>
                                    </form>
                             @endif
                        </div>
                    @endif
                    </div>
                @endforeach
            </section>
        @endif
    </div>
</main>

<script>
function toggleDocs(id) {
    const el = document.getElementById('docs-' + id);

    if (el.style.display === 'none' || el.style.display === '') {
        el.style.display = 'block';
    } else {
        el.style.display = 'none';
    }
};

setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert=> {
        alert.style.display = 'none';
    });
    
}, 3000);
    </script> 

<style>

.view-doc-btn{
    display:inline-block;
    padding:3px 5px;
    background:#3498db;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-size:12px;
    text-align:center;
}

.view-doc-btn:hover{
    background:#2980b9;
}

.no-doc{
    color:red;
    font-weight:bold;
}
.dashboard-header {
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px; 
    }

.dashboard-header h1 {
font-size:38px;
 font-weight:700;
  color:#f5d042; 
}

.header-left{
display:flex;
flex-direction:column;
}

.filter-form{
display:flex;
align-items:center;
}

.filter-box{
padding:8px 12px;
border-radius:8px;
border:none;
font-size:14px;
cursor:pointer;
background:white;
color:black;
}

.stat-card a{
display:block;
text-decoration:none;
color:inherit;
width:100%;
height:100%;
}


.dashboard-header p { 
    font-size:20px;
     color:#ccc;
      margin-top:5px; 
       font-family:'Inter',sans-serif
}

.alert { 
max-width:1000px; 
margin:20px auto; 
padding:12px 20px;
 border-radius:12px; 
 font-weight:600; 
 text-align:center; 
 color:#fff; }

.alert.success {
     background:#10b981;
     }
.alert.error {
     background:#ef4444; 
    }


.stats { 
    display:grid; 
    grid-template-columns:repeat(5,1fr);
     gap:20px;
     margin-bottom:50px;
     }

.stat-card {
     border-radius:20px;
      padding:20px 15px; 
      text-align:center; 
      box-shadow:0 10px 30px rgba(0,0,0,0.5);
       transition:0.3s; 
       font-weight:600; 
        font-family:'Inter',sans-serif;
        text-decoration:none;
        display: flex;
        flex-direction:column;
        justify-content: center;
        align-items: center;
    }

.stat-card:hover { 
    transform:translateY(-5px);
     box-shadow:0 16px 35px rgba(0,0,0,0.7); 
    }

.stat-card span {
    font-size:16px;
    opacity:0.8; 
    display:block;
    margin-bottom:5px;
     }

.stat-card h2 { 
    font-size:14px; 
    margin:0; 
}

.stat-card.gold {
     background: linear-gradient(135deg,#d4af37,#f5d042); 
     color:black;
     }
.stat-card.teal {
     background: linear-gradient(135deg,#1abc9c,#16a085);
     color:black;
     }

.stat-card.violet { 
    background: linear-gradient(135deg,#8e44ad,#9b59b6);
    color:black;
 }

.stat-card.blue { 
    background: linear-gradient(135deg,#3498db,#2980b9);
    color:black; 
}

.stat-card.orange { 
    background: linear-gradient(135deg,#e67e22,#d35400); 
    color:black;
}

.campaigns { 
    display:grid;
    grid-template-columns: repeat(4,250px);
    gap:25px; 
   justify-content:center;
   align-items: stretch;
   margin-top: 40px;
     }

.campaign-card {
    background:rgba(0,0,0,0.6);
    border-radius:22px;
    padding:25px; 
    box-shadow:0 15px 35px rgba(0,0,0,0.6);
    display:flex;
    flex-direction:column; 
    justify-content: space-between;
    gap:12px; 
    transition:0.3s;
}
.campaign-card:hover { 
    transform:translateY(-8px);
     box-shadow:0 20px 45px rgba(0,0,0,0.8);
     }

.card-header {
     display:flex;
      justify-content:space-between;
       align-items:center;
        font-size:14px; 
        color:#ccc; 
    }
.status { 
    padding:5px 12px;
    border-radius:12px;
    color:#fff; 
    font-weight:600; 
    font-size:12px;
    text-transform:capitalize; }

.status.pending {
     background:#f39c12;
     }
.status.approved {
     background:#27ae60;
     }
.status.rejected {
     background:#c0392b;
     }
.status.completed { 
    background:#2980b9;
 }

.campaign-img, .campaign-video {
     width:100%;
      height:140px; 
      border-radius:12px; 
      object-fit:cover; 
    }

h3 { 
    font-size:18px; 
    font-weight:600;
     margin:5px 0; 
     color:#f5f5f5;
     }

p { 
    font-size:14px; 
    color:#ccc;
 font-family:'Inter',sans-serif
 }

.goal-bar { 
    display:flex;
     flex-direction:column; 
     gap:5px; 
     font-size:14px; 
     color:#fff;
    }

.progress-bar {
     background: rgba(255,255,255,0.1); 
     height:6px;
    border-radius:8px;
    overflow:hidden; 
    }

.progress { 
    height:100%;
     background:#f5d042; 
    }


.actions { 
    display:flex;
     gap:13px; 
     justify-content:center;
      margin-top:10px;
     }

.actions button { 
    flex:1; 
    padding:8px; 
    border:none;
    border-radius:20px; 
    font-size:12px;
    font-weight:600; 
    cursor:pointer;
    transition:0.2s;
    color:#fff;
     }
.actions .approve {
     background:#27ae60;
     }
.actions .approve:hover { 
    background:#1e8449;
 }
.actions .reject { 
    background:#c0392b;
 }
.actions .reject:hover {
     background:#922b21;
     }

.actions .request{
        background: #f59e0b;
     }
     .actions .request:hover{
        background: #d97706;
     }

.empty-state {
     background:#1b1c2e; 
     padding:40px 20px; 
     border-radius:20px;
      text-align:center;
       box-shadow:0 15px 35px rgba(0,0,0,0.6);
     }

.empty-state h2 {
     font-size:24px;
 margin-bottom:10px; 
 color:#f5d042; 
}

.empty-state p { 
    font-size:14px;
     color:#ccc;
     }

.empty-state a.btn {
     display:inline-block;
      margin-top:20px;
       padding:10px 20px;
        border-radius:12px; 
        background:#2980b9;
         color:#fff; 
         text-decoration:none;
          font-weight:600;
           transition:0.2s;
         }

.empty-state a.btn:hover {
     background:#1c5980; 
    }

.ai-box{
background:rgba(255,255,255,0.05);
padding:10px;
border-radius:10px;
margin-top:10px;
font-size:13px;
border-left:4px solid #f5d042;
color:#ddd;
}

.ai-box h4{
color:#f5d042;
font-size:14px;
margin-bottom:6px;
}

.risk{
display:inline-block;
padding:4px 10px;
border-radius:8px;
font-size:12px;
font-weight:600;
text-transform:capitalize;
letter-spacing:0.5px;
}


.risk.low{
background:#27ae60;
color:white;
}

.risk.medium{
background:#f39c12;
color:white;
}

.risk.high{
background:#e74c3c;
color:white;
}
.request-doc-btn{
   
}

@media (max-width:768px) { .stats { grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); } .campaign-card { width:100%; } }

</style>

</x-admin-layout>