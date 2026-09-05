<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Interactive practice platform for mastering Machine Learning, Neural Networks, and AI models through hands-on tracks.">

    <title>@yield('title', 'ML Practice - Interactive Machine Learning Learning')</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Platform Styles -->
    <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}">
</head>
<body>

    <!-- Main Navigation Bar -->
    <header class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{ route('landing') }}" class="brand-logo">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <span class="brand-text">ML<span>Path</span></span>
                </a>

                <nav>
                    <ul class="nav-links">
                        <li><a href="{{ route('landing') }}" class="nav-link">Home</a></li>
                        
                        @auth
                            <li><a href="{{ route('home') }}" class="nav-link">Practice Workspace</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline" style="padding: 6px 14px; font-size: 0.85rem;">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="nav-link">Sign In</a></li>
                            <li><a href="{{ route('register') }}" class="btn btn-primary" style="padding: 8px 18px; font-size: 0.88rem;">Get Started</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Dynamic Content -->
    <main class="main-content">
        @if (session('success'))
            <div class="container" style="margin-top: 20px;">
                <div class="alert-box alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container" style="margin-top: 20px;">
                <div class="alert-box alert-error">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if (session('info'))
            <div class="container" style="margin-top: 20px;">
                <div class="alert-box alert-info">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <span>{{ session('info') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-weight: 700; color: var(--text-main);">MLPath Platform</span>
                    <span>&bull;</span>
                    <span>Interactive Machine Learning Practice</span>
                </div>
                <div>
                    <span>&copy; {{ date('Y') }} MLPath. All rights reserved.</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
