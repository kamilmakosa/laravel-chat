@extends('layout')

@section('body')
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="{{ route('contacts') }}" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="{{ asset($talkUser->avatar) }}" alt="User Avatar">
                <div class="details">
                    <span>{{ $talkUser->fname }} {{ $talkUser->lname }}</span>
                    <p id="status"></p>
                </div>
            </header>
            <div class="chat-box">
                <div class="messages"></div>
                <div class="chat incoming chat-bubble off">
                    <img src="{{ asset($talkUser->avatar) }}" alt="">
                    <div class="details">
                        <div class="typing-chat">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="#" class="typing-area">
                <input type="text" class="sender_id" name="sender_id" value="{{ $user->id }}" hidden>
                <input type="text" class="receiver_id" name="receiver_id" value="{{ $talkUser->id }}" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

<script>
var apiMessageURL = "{{ asset('api/messages') }}";
</script>
<script src="{{ asset('js/chat.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
const URL = '{{ asset('') }}';
var user = @json(Auth::user());
var talkUser = @json($talkUser);

function sendTypingEvent() {
    console.log('typing');
    Echo.private('chat.{{ $user->id }}.{{ $talkUser->id }}')
        .whisper('typing', { userID: {{ $user->id }} });
}

var typingTimeout;

Echo.private('chat.{{ $talkUser->id }}.{{ $user->id }}')
    .listenForWhisper('typing', (data) => {
        console.log(data);
        chatBubble = document.querySelector(".chat-bubble");
        chatBubble.classList.remove("off");
        clearTimeout(typingTimeout);
        typingTimeout = setTimeout(() => {
            chatBubble.classList.add("off");
        }, 1500);
    });

var statusTimeout;

Echo.private('chat')
    .listenForWhisper('status', (data) => {
        userStatus = document.querySelector("#status");
        if(data.userID == {{ $talkUser->id }}) {
            clearTimeout(statusTimeout);
            userStatus.innerHTML = "Active now";
            statusTimeout = setTimeout(() => {
                userStatus.innerHTML = "";
            }, 10000);
        }
    });

statusBroadcastingInterval = setInterval(() => {
    Echo.private('chat').whisper('status', { userID: user.id, status: 'active' })
}, 2000);
</script>

</body>
@endsection