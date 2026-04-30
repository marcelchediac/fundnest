<div class="campaign-page-container">

    <div class="campaign-left">
        <h1 class="campaign-title">{{ $campaign->title }}</h1>

        @if($campaign->video_url)
            <iframe width="70%" height="250"
                src="{{ str_replace('watch?v=', 'embed/', $campaign->video_url) }}"
                frameborder="0" allowfullscreen
                class="campaign-video"></iframe>
        @endif

        <img src="{{ $campaign->image ? asset('storage/'.$campaign->image) : asset('images/default-campaign.jpg') }}"
             alt="{{ $campaign->title }}" class="campaign-image">

        <p class="campaign-description">{{ $campaign->description }}</p>


        <hr style="border-color: rgba(255,255,255,0.2);">

        <h3>Comments</h3>
        <div class="comments-section">
            @forelse($campaign->comments ?? [] as $comment)
                <p><strong>{{ $comment->user->name ?? 'Anonymous' }}:</strong> {{ $comment->content }}</p>
            @empty
                <p>No comments yet. Be the first to comment!</p>
            @endforelse
        </div>

        @auth
            <form action="{{ route('campaign.comment', $campaign->id) }}" method="POST" class="comment-form">
             @csrf
              <div class="emoji-picker">
        <button type="button" class="emoji-btn">❤️</button>
        <button type="button" class="emoji-btn">👏</button>
        <button type="button" class="emoji-btn">😂</button>
        <button type="button" class="emoji-btn">👍</button>
    </div>
        <textarea name="content" rows="3" placeholder="Add a comment..." required></textarea>
        <button type="submit" class="btn-donate">Post Comment</button>
    </form>
@else
    <p><a href="{{ route('login') }}">Log in</a> to comment or donate.</p>
@endauth
</div>

    <div class="campaign-right">
        <div class="amount-box">
            <div class="progress-circle">
                <span>{{ round(($campaign->collected_amount / max($campaign->goal_amount,1)) * 100) }}%</span>
            </div>
            <p><strong>${{ number_format($campaign->collected_amount) }}</strong> raised</p>
            <p>of ${{ number_format($campaign->goal_amount) }}</p>

            <a href="{{ route('donations.create', $campaign->id) }}" class="btn-donate">Donate Now</a>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const emojiButtons = document.querySelectorAll('.emoji-btn');
    const textarea = document.querySelector('textarea[name="content"]');

    emojiButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const emoji = btn.textContent;
            textarea.value += emoji;
            textarea.focus();
        });
    });
});
</script>

<style>
body {
    background: linear-gradient(135deg, #0b0c2a, #1f1460, #3a00ff);
    min-height: 100vh;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    color: #fff;
}

.campaign-page-container {
    display: flex;
    gap: 40px;
    max-width: 1100px;
    margin: 50px auto;
    padding: 20px;
}

.campaign-left {
    flex: 2;
}

.campaign-title {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 15px;
}

.campaign-image {
    width: 30%;
    border-radius: 15px;
    margin: 20px 0;
    object-fit: cover;
}

.campaign-description {
    font-size: 18px;
    line-height: 1.6;
}


.comments-section p {
    background: rgba(255, 255, 255, 0.1);
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 8px;
}

.comment-form textarea {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    margin-top: 10px;
    resize: vertical;
    font-size: 16px;
}

.comment-form button {
    margin-top: 10px;
}

.emoji-picker {
    margin-bottom: 8px;
}

.emoji-btn {
    font-size: 18px;
    background: none;
    border: none;
    cursor: pointer;
    margin-right: 5px;
    transition: transform 0.1s;
}

.emoji-btn:hover {
    transform: scale(1.2);
}

.campaign-right {
    flex: 1;
}

.amount-box {
    background: rgba(0, 0, 0, 0.3);
    padding: 30px;
    border-radius: 20px;
    text-align: center;
}

.progress-circle {
    width: 100px;
    height: 100px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: conic-gradient(#38ef7d {{ round(($campaign->collected_amount / max($campaign->goal_amount,1)) * 100) }}%, rgba(255,255,255,0.1) 0%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 20px;
    color: #fff;
}

.btn-donate {
    display: inline-block;
    padding: 12px 25px;
    font-size: 16px;
    font-weight: 700;
    border-radius: 15px;
    text-decoration:none;
    color: #fff;
    background: linear-gradient(135deg, #38ef7d, #11998e);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.btn-donate:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    background: linear-gradient(135deg, #11998e, #38ef7d);
}

@media screen and (max-width: 900px) {
    .campaign-page-container {
        flex-direction: column;
    }
    .campaign-right {
        margin-top: 30px;
    }
}
</style>