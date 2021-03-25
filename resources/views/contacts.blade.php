@extends('layout')

@section('body')
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="{{ asset($user->avatar) }}" alt="">
                    <div class="details">
                        <span>{{ $user->fname }} {{ $user->lname }}</span>
                        <p><?php //echo $row['status']; ?></p>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
				@foreach ($users as $user)
				<a id="user{{ $user->id }}" href="{{ route('chat', ['id' => $user->id]) }}">
                    <div class="content">
                    <img src="{{ asset($user->avatar) }}" alt="">
                    <div class="details">
                        <span>{{ $user->fname }} {{ $user->lname }}</span>
                        <!-- <p>'. $you . $msg .'</p> -->
                    </div>
                    </div>
                    <div class="status-dot offline"><i class="fas fa-circle"></i></div>
                </a>
				@endforeach
            </div>
        </section>
    </div>

<script src="{{ asset('js/users.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
var user = @json(Auth::user());

var timeouts = {};

Echo.private('chat')
    .listenForWhisper('status', (data) => {
        userTag = document.querySelector("#user"+data.userID);
        dot = userTag.querySelector(".status-dot");
        dot.classList.remove("offline");
        clearTimeout(timeouts[data.userID]);
        timeouts[data.userID] = setTimeout(() => {
            dot.classList.add("offline");
        }, 10000);
    });

statusBroadcastingInterval = setInterval(() => {
    Echo.private('chat').whisper('status', { userID: user.id, status: 'active' })
}, 2000);
</script>

</body>
@endsection