<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="{{ session('settings.primary_color', cache()->get("app_settings_appearance", [])['primary_color'] ?? '#20a770') }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --color-primary: {{ session('settings.primary_color', cache()->get("app_settings_appearance", [])['primary_color'] ?? '#20a770') }};
                --color-secondary: {{ session('settings.secondary_color', cache()->get("app_settings_appearance", [])['secondary_color'] ?? '#0D8ABC') }};
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html, body {
                height: 100%;
                width: 100%;
                font-family: 'Figtree', 'Inter', sans-serif;
            }

            body {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                padding: 1rem;
            }

            .login-container {
                width: 100%;
                max-width: 420px;
                background: white;
                border-radius: 16px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
                overflow: hidden;
            }

            .login-header {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
                padding: 3rem 2rem;
                text-align: center;
                color: white;
            }

            .login-logo {
                height: 80px;
                width: 80px;
                margin: 0 auto 1.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 12px;
            }

            .login-logo img {
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
            }

            .login-logo i {
                font-size: 2.5rem;
            }

            .login-header h1 {
                font-size: 1.75rem;
                font-weight: 800;
                margin-bottom: 0.5rem;
                letter-spacing: -0.5px;
            }

            .login-header p {
                font-size: 0.95rem;
                opacity: 0.9;
                font-weight: 500;
            }

            .login-body {
                padding: 2.5rem 2rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #111827;
                font-size: 0.95rem;
            }

            .form-group input {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 2px solid #e5e7eb;
                border-radius: 8px;
                font-size: 1rem;
                transition: all 0.3s ease;
                font-family: inherit;
            }

            .form-group input:focus {
                outline: none;
                border-color: var(--color-primary);
                box-shadow: 0 0 0 3px rgba(32, 167, 112, 0.1);
            }

            .form-group input::placeholder {
                color: #9ca3af;
            }

            .remember-forgot {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .remember-me {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                cursor: pointer;
            }

            .remember-me input {
                width: auto;
                margin: 0;
            }

            .remember-me label {
                margin: 0;
                cursor: pointer;
                font-size: 0.9rem;
                font-weight: 500;
                color: #6b7280;
            }

            .forgot-link {
                color: var(--color-primary);
                text-decoration: none;
                font-weight: 600;
                font-size: 0.9rem;
                transition: color 0.2s;
            }

            .forgot-link:hover {
                color: var(--color-secondary);
            }

            .login-button {
                width: 100%;
                padding: 0.875rem;
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
            }

            .login-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(32, 167, 112, 0.3);
            }

            .login-button:active {
                transform: translateY(0);
            }

            .error-messages {
                background: #fee;
                color: #c33;
                padding: 1rem;
                border-radius: 8px;
                margin-bottom: 1.5rem;
                border-left: 4px solid #c33;
            }

            .error-messages ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .error-messages li {
                font-size: 0.9rem;
                line-height: 1.5;
            }

            @media (max-width: 480px) {
                .login-container {
                    max-width: 100%;
                }

                .login-header {
                    padding: 2.5rem 1.5rem;
                }

                .login-header h1 {
                    font-size: 1.5rem;
                }

                .login-body {
                    padding: 2rem 1.5rem;
                }

                .remember-forgot {
                    flex-direction: column;
                    align-items: flex-start;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            {{ $slot }}
        </div>
    </body>
</html>
