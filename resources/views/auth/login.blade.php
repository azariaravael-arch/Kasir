<x-guest-layout>
<div class="login-header">
    <div class="login-logo">
        @php
            $logoPath = session('settings.logo_path', cache()->get("app_settings_appearance", [])['logo_path'] ?? null);
        @endphp
        @if($logoPath)
            <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo">
        @else
            <i class="fas fa-cash-register"></i>
        @endif
    </div>
    <h1>{{ session('settings.store_name', cache()->get("app_settings_store", [])['store_name'] ?? config('app.name', 'Kasir')) }}</h1>
    <p>Sistem Kasir & Inventori Terpadu</p>
</div>

<div class="login-body">
    <!-- Session Status -->
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">
                <i class="fas fa-envelope mr-2"></i>Email Address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">
                <i class="fas fa-lock mr-2"></i>Password
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
        </div>

        <!-- Remember Me -->
        <div class="remember-forgot">
            <label class="remember-me">
                <input type="checkbox" name="remember">
                <span>Remember me</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    <i class="fas fa-question-circle mr-1"></i>Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="login-button">
            <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
    </form>
</div>
</x-guest-layout>
