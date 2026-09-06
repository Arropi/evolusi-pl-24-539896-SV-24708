@extends('layouts.app')

@section('title', 'Welcome to Home - MLPath Platform')

@section('content')
<div class="container">
    <!-- Header: Welcome to Home & User Profile Overview -->
    <div class="dashboard-header">
        <div class="dashboard-user-card">
            <div class="user-info-group">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <h1>Welcome to Home, {{ $user->name }}!</h1>
                    <p>Logged in as <strong style="color: var(--text-main);">{{ $user->email }}</strong> &bull; Member since {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>

            <div class="user-stats-strip">
                <div class="stat-pill">
                    <div class="stat-pill-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <div class="stat-pill-data">
                        <h5>370 XP</h5>
                        <span>Total Earned</span>
                    </div>
                </div>

                <div class="stat-pill">
                    <div class="stat-pill-icon" style="color: var(--color-amber);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 14 14"></polyline>
                        </svg>
                    </div>
                    <div class="stat-pill-data">
                        <h5>Day 1</h5>
                        <span>Practice Streak</span>
                    </div>
                </div>

                <div class="stat-pill">
                    <div class="stat-pill-icon" style="color: var(--color-cyan);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                    <div class="stat-pill-data">
                        <h5>Level 1</h5>
                        <span>Tensor Novice</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Workspace / Practice Nodes Roadmap -->
    <div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 32px; align-items: start;">
        <!-- Left Column: Interactive Learning Path (Duolingo Style Modules) -->
        <div>
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h2 class="roadmap-section-title" style="margin-bottom: 0;">Interactive Practice Roadmap</h2>
                <span style="font-size: 0.85rem; color: var(--text-dim);">1 of 5 Modules Completed</span>
            </div>

            <div class="modules-list">
                @foreach ($practiceModules as $module)
                    <div class="module-card is-{{ $module['status'] }}">
                        <div class="module-index">
                            @if ($module['status'] === 'completed')
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            @elseif ($module['status'] === 'in_progress')
                                <span>{{ $module['id'] }}</span>
                            @else
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="module-info">
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                                <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--color-cyan); letter-spacing: 0.05em;">{{ $module['level'] }}</span>
                                <span style="color: var(--text-dim); font-size: 0.75rem;">&bull;</span>
                                <span style="font-size: 0.78rem; font-family: var(--font-mono); color: var(--color-emerald); font-weight: 700;">+{{ $module['xp'] }} XP</span>
                            </div>

                            <h3>{{ $module['title'] }}</h3>
                            <p>{{ $module['description'] }}</p>

                            <div class="progress-bar-container">
                                <div class="progress-bar-fill" style="width: {{ $module['progress'] }}%;"></div>
                            </div>
                        </div>

                        <div class="module-action">
                            @if ($module['status'] === 'completed')
                                <button type="button" class="btn btn-secondary" style="font-size: 0.82rem; padding: 8px 14px;">Review</button>
                            @elseif ($module['status'] === 'in_progress')
                                <button type="button" class="btn btn-primary" style="font-size: 0.85rem; padding: 10px 18px;">Continue Lab</button>
                            @else
                                <button type="button" class="btn btn-outline" disabled style="font-size: 0.82rem; padding: 8px 14px; opacity: 0.5; cursor: not-allowed;">Locked</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Column: Quick Status & Account Actions Card -->
        <div>
            <div style="background: var(--bg-card); border: 1px solid var(--border-subtle); border-radius: var(--radius-md); padding: 24px; margin-bottom: 24px;">
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 16px; color: var(--text-main);">Practice Session Goal</h3>
                <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 20px;">Complete 1 interactive lab today to maintain your consecutive learning streak.</p>

                <div style="background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: var(--radius-sm); padding: 14px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.82rem; margin-bottom: 6px;">
                        <span style="color: var(--text-main); font-weight: 600;">Daily Target</span>
                        <span style="color: var(--color-emerald); font-weight: 700;">60%</span>
                    </div>
                    <div class="progress-bar-container" style="margin-top: 0;">
                        <div class="progress-bar-fill" style="width: 60%;"></div>
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border-subtle); padding-top: 20px;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span>Logout from Session</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
