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
                    <p><?php //echo $row['status']; ?></p>
                </div>
            </header>
            <div class="chat-box">

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

</body>
@endsection