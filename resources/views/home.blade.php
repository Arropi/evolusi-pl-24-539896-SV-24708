@extends('layouts.app')

@section('title', 'Practice Workspace - MLPath Platform')

@section('content')
<div class="container">
    <!-- Header: User Profile & Progress Dashboard -->
    <div class="dashboard-header">
        <div class="dashboard-user-card">
            <div class="user-info-group">
                <div class="user-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <h1>Welcome to Home, {{ $user->name }}!</h1>
                    <p>Akun: <strong style="color: var(--text-main);">{{ $user->email }}</strong> &bull; Member sejak {{ $user->created_at->format('M Y') }}</p>
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
                        <h5>{{ $totalXp }} XP</h5>
                        <span>Total Poin</span>
                    </div>
                </div>

                <div class="stat-pill">
                    <div class="stat-pill-icon" style="color: var(--color-cyan);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                    </div>
                    <div class="stat-pill-data">
                        <h5>Level {{ $level }}</h5>
                        <span>{{ $level === 1 ? 'Tensor Novice' : ($level === 2 ? 'Vector Apprentice' : 'Matrix Master') }}</span>
                    </div>
                </div>

                <div class="stat-pill">
                    <div class="stat-pill-icon" style="color: var(--color-emerald);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                    </div>
                    <div class="stat-pill-data">
                        <h5>{{ $completedLessonsCount }} / {{ $totalLessonsCount }}</h5>
                        <span>Modul Selesai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Workspace Layout -->
    <div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 32px; align-items: start;">
        <!-- Left Column: Database-Driven Learning Roadmap & Skill Mastery Matrix -->
        <div>
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h2 class="roadmap-section-title" style="margin-bottom: 0;">Jalur Kurikulum & Praktik Interaktif</h2>
                <span style="font-size: 0.85rem; color: var(--text-dim); font-family: var(--font-mono); font-weight: 600;">
                    Progress Total: {{ $progressPercentage }}%
                </span>
            </div>

            @foreach ($tracks as $track)
                <div style="margin-bottom: 32px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; background: rgba(15, 23, 42, 0.9); border: 1px solid var(--border-subtle); border-radius: var(--radius-sm); margin-bottom: 16px;">
                        <div>
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--color-cyan); letter-spacing: 0.05em;">Track {{ $track->order }}: {{ $track->level }}</span>
                            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--text-main); margin-top: 2px;">{{ $track->title }}</h3>
                        </div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); font-family: var(--font-mono);">{{ $track->lessons->count() }} Modul Lab</span>
                    </div>

                    <div class="modules-list">
                        @foreach ($track->lessons as $lesson)
                            <div class="module-card {{ $lesson->is_completed ? 'is-completed' : ($lesson->is_unlocked ? 'is-active' : 'is-locked') }}">
                                <div class="module-index">
                                    @if ($lesson->is_completed)
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @elseif ($lesson->is_unlocked)
                                        <span>{{ $lesson->order }}</span>
                                    @else
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    @endif
                                </div>

                                <div class="module-info">
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                                        <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--color-cyan); letter-spacing: 0.05em;">Modul {{ $lesson->order }}</span>
                                        <span style="color: var(--text-dim); font-size: 0.75rem;">&bull;</span>
                                        <span style="font-size: 0.78rem; font-family: var(--font-mono); color: var(--color-emerald); font-weight: 700;">+{{ $lesson->xp_reward }} XP</span>
                                        <span style="color: var(--text-dim); font-size: 0.75rem;">&bull;</span>
                                        <span style="font-size: 0.78rem; color: var(--text-muted);">{{ $lesson->estimated_minutes }} Menit</span>
                                    </div>

                                    <h3>{{ $lesson->title }}</h3>
                                    <p>{{ $lesson->summary }}</p>

                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill" style="width: {{ $lesson->is_completed ? 100 : ($lesson->is_unlocked ? 0 : 0) }}%;"></div>
                                    </div>
                                </div>

                                <div class="module-action">
                                    @if ($lesson->is_completed)
                                        <a href="{{ route('lessons.show', $lesson->slug) }}" class="btn btn-secondary" style="font-size: 0.82rem; padding: 8px 14px;">
                                            <span>Buka Ulang</span>
                                        </a>
                                    @elseif ($lesson->is_unlocked)
                                        <a href="{{ route('lessons.show', $lesson->slug) }}" class="btn btn-primary" style="font-size: 0.85rem; padding: 10px 18px;">
                                            <span>Mulai Praktik</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-outline" disabled style="font-size: 0.82rem; padding: 8px 14px; opacity: 0.5; cursor: not-allowed;">
                                            <span>Terkunci</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- ML Skill Mastery Matrix Section -->
            <div class="mastery-matrix-section">
                <div class="mastery-matrix-header">
                    <div>
                        <span class="mastery-tag">Evaluasi Kompetensi Real-Time</span>
                        <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-main); margin-top: 2px;">ML Skill Mastery Matrix (5 Pilar AI)</h3>
                    </div>
                    <span style="font-size: 0.8rem; color: var(--text-dim); font-family: var(--font-mono);">Database-Driven</span>
                </div>

                <div class="mastery-grid">
                    @foreach ($skillMatrix as $skill)
                        <div class="mastery-card">
                            <div>
                                <span class="mastery-tag">{{ $skill['tag'] }}</span>
                                <h4 class="mastery-name">{{ $skill['pillar'] }}</h4>
                                <p class="mastery-desc">{{ $skill['description'] }}</p>
                            </div>
                            <div class="mastery-bar-wrapper">
                                <div class="mastery-bar">
                                    <div class="mastery-bar-fill" style="width: {{ $skill['percentage'] }}%;"></div>
                                </div>
                                <span class="mastery-val">{{ $skill['percentage'] }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column: Achievement Badges Showcase & Quick Syntax Cheat Sheet -->
        <div>
            <!-- Achievement Badges Card -->
            <div class="sidebar-card">
                <div class="sidebar-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--color-amber);">
                        <circle cx="12" cy="8" r="7"></circle>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    </svg>
                    <span>Achievement Badges</span>
                </div>
                <p class="sidebar-subtitle">Medali digital yang terbuka seiring penyelesaian modul lab.</p>

                <div class="badges-grid">
                    @foreach ($achievements as $ach)
                        <div class="badge-item {{ $ach->is_unlocked ? 'is-unlocked' : 'is-locked' }}">
                            <div class="badge-icon-box">
                                @if ($ach->icon === 'layers')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                @elseif ($ach->icon === 'zap')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                    </svg>
                                @elseif ($ach->icon === 'check-circle')
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                @else
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>
                                @endif
                            </div>

                            <div class="badge-info">
                                <h5>{{ $ach->title }}</h5>
                                <p>{{ $ach->description }}</p>
                            </div>

                            <div class="badge-xp-tag">
                                {{ $ach->is_unlocked ? 'Terbuka' : '+' . $ach->xp_reward . ' XP' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick ML Syntax & Formula Cheat Sheet -->
            <div class="sidebar-card">
                <div class="sidebar-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--color-cyan);">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                    </svg>
                    <span>ML Formula & Syntax Cheat Sheet</span>
                </div>
                <p class="sidebar-subtitle">Referensi cepat sintaks penting dengan tombol 1-Click Copy.</p>

                @foreach ($cheatSheetItems as $index => $item)
                    <div class="cheatsheet-item">
                        <div class="cheatsheet-header">
                            <span class="cheatsheet-title">{{ $item['title'] }}</span>
                            <button type="button" class="copy-btn" onclick="copySnippet(this, 'snippet-{{ $index }}')">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                                <span>Copy</span>
                            </button>
                        </div>
                        <pre class="cheatsheet-code" id="snippet-{{ $index }}">{{ $item['code'] }}</pre>
                        <p class="cheatsheet-desc">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Logout & Session Actions -->
            <div class="sidebar-card">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Keluar dari Sesi</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copySnippet(button, elementId) {
        const textToCopy = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(textToCopy).then(() => {
            const originalHtml = button.innerHTML;
            button.classList.add('copied');
            button.innerHTML = `
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Tersalin!</span>
            `;
            setTimeout(() => {
                button.classList.remove('copied');
                button.innerHTML = originalHtml;
            }, 2000);
        }).catch(err => {
            console.error('Gagal menyalin:', err);
        });
    }
</script>
@endpush
