<x-contact-navbar>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@if(session('success'))
    <div class="contact-success">
        <h4>💙 Thank you for reaching out!</h4>
        <p>
            We’ve received your message and truly appreciate you taking the time to contact us.
            Our team will review it and get back to you as soon as possible.
        </p>
        <small>
            In the meantime, feel free to explore campaigns or visit our Help Center.
        </small>
    </div>
@endif

<main class="contact-page">

    <section class="contact-hero">
        <h1>Contact FundNest</h1>
        <p>We’re here to help. Reach out anytime.</p>
    </section>

    <section class="contact-content">

        <div class="contact-info">
            <h3>Get in touch</h3>
            <div class="info-item">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <p>chediacmarcel@gmail.com</p>
                    <p>jzaouk@gmail.com</p>
                </div>
            </div>
            <div class="info-item">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <span>+961 79 322 130</span>
                    <span>+961 71 801 560</span>
                </div>
            </div>
            <div class="info-item">
                <i class="bi bi-geo-alt-fill"></i>
                <span>Lebanon</span>
            </div>
            <p class="info-note">
                Our support team usually responds within 24 hours.
            </p>
        </div>

        <div class="contact-form-wrapper">
            <form class="contact-form" method="POST" action="{{ route('contact.store') }}">
                @csrf
                <h3>Send us a message</h3>
                <input type="text" name="name" placeholder="Your name" required>
                <input type="email" name="email" placeholder="Your email" required>
                <textarea name="message" rows="5" placeholder="Enter your issue" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <div id="chatbot-bubble">
    💬
</div>

<div id="chatbot-window">
    <div id="chatbot-header">
        <span>AI Assistant</span>
        <button id="chatbot-close">×</button>
    </div>
    <div id="chatbot-messages"></div>
    <div id="chatbot-input-area">
        <input type="text" id="chatbot-input" placeholder="Type your message..." />
        <button id="chatbot-send">Send</button>
    </div>
</div>



    </section>

</main>

<style>
#chatbot-bubble {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background: linear-gradient(135deg, #38ef7d, #11998e);
    color: #fff;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    font-size: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    z-index: 9999;
    transition: transform 0.2s;
}

#chatbot-window {
    position: fixed;
    bottom: 40px;
    right: 25px;
    width: 350px;
    max-height: 300px;
    background: rgba(0,0,0,0.9);
    border-radius: 15px;
    display: none;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    z-index: 10000;
    font-family: 'Segoe UI', sans-serif;
}
#chatbot-header {
    background: linear-gradient(135deg, #38ef7d, #11998e);
    color: #fff;
    padding: 12px;
    display: flex;
    justify-content: space-between;
    font-weight: 700;
}
#chatbot-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background: rgba(0,0,0,0.7);
}
.bot-message, .user-message {
    padding: 8px 12px;
    margin: 6px 0;
    border-radius: 15px;
    max-width: 80%;
    word-wrap: break-word;
    animation: fadeIn 0.3s ease;
}

.user-message {
    background: #38ef7d;
    color: #000;
    align-self: flex-end;
}
.bot-message {
    background: #2c2c54;
    color: #fff;
    align-self: flex-start;
}

#chatbot-input-area {
    display: flex;
    border-top: 1px solid #444;
    padding: 10px;
    background: rgba(0,0,0,0.8);
}

#chatbot-input {
    flex: 1;
    padding: 10px;
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 14px;
    margin-right: 5px;
    background: rgba(255,255,255,0.1);
    color: #fff;
}

#chatbot-send {
    background: linear-gradient(135deg, #38ef7d, #11998e);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 10px 15px;
    cursor: pointer;
    font-weight: 700;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(10px);}
    to {opacity: 1; transform: translateY(0);}
}

.contact-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #121250, #3c1878);
    color: #fff;
    padding-bottom: 80px;
    font-family: 'Segoe UI', sans-serif;
}

.contact-hero {
    text-align: center;
    padding: 80px 20px 40px;
}

.contact-hero h1 {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 10px;
}

.contact-hero p {
    font-size: 18px;
    opacity: 0.9;
}

.contact-content {
    max-width:1000px;
    margin:auto;
    display:flex;
    gap:40px;
    padding:40px 20px;
    flex-wrap:wrap;
}

.contact-info {
    flex: 1;
     min-width: 280px; 
     background: rgba(255,255,255,0.08);
     backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
}

.contact-info h3 {
    font-weight: 700;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 15px;
    font-size: 16px;
}

.info-item i {
    font-size: 20px;
    color: #38ef7d;
    margin-top: 3px;
}

.info-note {
    margin-top: 20px;
    opacity: 0.85;
    font-size: 14px;
}

.contact-form-wrapper {
   flex: 1;
    min-width: 300px;
    display:flex;
    flex-direction:column;
    gap:30px;
}

.contact-form {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
}

.contact-form h3 {
    font-weight: 700;
    margin-bottom: 20px;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 15px;
    background: rgba(255,255,255,0.1);
    color: #fff;
}

.contact-form button {
    width: 100%;
    padding: 14px;
    border-radius: 30px;
    border: none;
    font-weight: 700;
    font-size: 16px;
    background: linear-gradient(90deg, #38ef7d, #11998e);
    color: #fff;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.contact-form button:hover {
    transform: translateY(-2px);
}

.contact-success {
    background:linear-gradient(rgba(18,18,80,0.85), rgba(60,18,120,0.9));
    color: #fff;
    padding: 25px;
    border-radius: 14px;
    margin-bottom:30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    animation: fadeSlide 0.5s ease;
}

.contact-success h4 {
    font-weight: 800;
    margin-bottom: 8px;
}

.contact-success p {
    font-size: 16px;
    margin-bottom: 6px;
}

.contact-success small {
    opacity: 0.9;
}

.ai-chat-container {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.ai-chat-container h3 {
    font-weight: 700;
    margin-bottom: 15px;
    color: #38ef7d;
}

.chat-messages {
    border:1px solid #38ef7d;
    padding:10px;
    height:300px;
    overflow-y:auto;
    border-radius:10px;
    background: rgba(0,0,0,0.15);
    font-size: 14px;
}

.chat-messages p {
    margin: 6px 0;
}

.chat-messages p strong {
    color: #38ef7d;
}

#userMessage {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 14px;
    background: rgba(255,255,255,0.1);
    color: #fff;
}

.ai-chat-container button {
    padding: 12px;
    border-radius: 20px;
    border: none;
    font-weight: 700;
    background: #38ef7d;
    color: #fff;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.ai-chat-container button:hover {
    transform: translateY(-2px);
}

@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>


<script>
const bubble = document.getElementById('chatbot-bubble');
const windowBox = document.getElementById('chatbot-window');
const closeBtn = document.getElementById('chatbot-close');
const messagesDiv = document.getElementById('chatbot-messages');
const input = document.getElementById('chatbot-input');
const sendBtn = document.getElementById('chatbot-send');


bubble.addEventListener('click', () => {
    windowBox.style.display = 'flex';
});

closeBtn.addEventListener('click', () => {
    windowBox.style.display = 'none';
});


async function sendMessage() {
    const message = input.value.trim();
    if (!message) return;


    const userMsg = document.createElement('div');
    userMsg.classList.add('user-message');
    userMsg.textContent = message;
    messagesDiv.appendChild(userMsg);
    input.value = '';
    messagesDiv.scrollTop = messagesDiv.scrollHeight;

    try {
        const response = await fetch('{{ route("chatbot.ask") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        });
        const data = await response.json();

        const botMsg = document.createElement('div');
        botMsg.classList.add('bot-message');
        botMsg.textContent = data.reply + (data.cached ? ' (cached)' : '');
        messagesDiv.appendChild(botMsg);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    } catch (error) {
        const botMsg = document.createElement('div');
        botMsg.classList.add('bot-message');
        botMsg.textContent = 'Error contacting AI';
        messagesDiv.appendChild(botMsg);
    }
}



sendBtn.addEventListener('click', sendMessage);
input.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendMessage();
});
</script>



</x-contact-navbar>