<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Kasir & Inventori Terpadu">
    <meta name="theme-color" content="{{ session('settings.primary_color', cache()->get("app_settings_appearance", [])['primary_color'] ?? '#20a770') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Mobile first responsive improvements */
        @media (max-width: 640px) {
            body {
                -webkit-text-size-adjust: 100%;
                -webkit-user-select: none;
                user-select: none;
                -webkit-touch-callout: none;
            }
            
            .premium-card {
                padding: 1rem;
                margin: 0;
            }
            
            button, a, input, select, textarea {
                -webkit-appearance: none;
                appearance: none;
                border-radius: 0.5rem;
            }
            
            input[type="text"],
            input[type="email"],
            input[type="number"],
            input[type="password"],
            input[type="date"],
            select,
            textarea {
                font-size: 16px;
            }
        }
        
        html, body {
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        /* Dynamic theme colors from settings */
        :root {
            --color-primary: {{ session('settings.primary_color', cache()->get("app_settings_appearance", [])['primary_color'] ?? '#20a770') }};
            --color-secondary: {{ session('settings.secondary_color', cache()->get("app_settings_appearance", [])['secondary_color'] ?? '#0D8ABC') }};
        }

        /* Apply dynamic primary color */
        nav {
            background-color: var(--color-primary) !important;
        }

        .bg-primary-500 {
            background-color: var(--color-primary) !important;
        }

        .text-primary-500 {
            color: var(--color-primary) !important;
        }

        .text-primary-600 {
            color: var(--color-primary) !important;
        }

        .primary-btn {
            background-color: var(--color-primary) !important;
        }

        .primary-btn:hover {
            filter: brightness(0.9);
        }

        .border-primary-500 {
            border-color: var(--color-primary) !important;
        }

        .focus\:ring-primary-500:focus {
            --tw-ring-color: var(--color-primary) !important;
        }

        .focus\:border-primary-500:focus {
            border-color: var(--color-primary) !important;
        }

        /* Apply dynamic secondary color */
        .bg-secondary-500 {
            background-color: var(--color-secondary) !important;
        }

        .text-secondary-500 {
            color: var(--color-secondary) !important;
        }

        .border-secondary-500 {
            border-color: var(--color-secondary) !important;
        }
    </style>
    
    @stack('styles')
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen bg-[#edf5f2] flex flex-col">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>

</html>