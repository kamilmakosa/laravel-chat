@extends('layout')

@section('body')
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @if ($errors->all())
				<div class="error-text">
					<div>{{ __('Whoops! Something went wrong.') }}</div>
					@foreach ($errors->all() as $error)
                	<div>{{ $error }}</div>
					@endforeach
				</div>
				@endif
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Not yet signed up? <a href="{{ route('register') }}">Signup now</a></div>
        </section>
    </div>
    
    <script src="{{ asset('js/pass-show-hide.js') }}"></script>
</body>
@endsection