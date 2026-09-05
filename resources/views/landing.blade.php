@extends('layouts.app')

@section('title', 'MLPath - Master Machine Learning Through Interactive Practice')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">

                <h1 class="hero-title">
                    Master <span class="text-gradient">Machine Learning</span> Step by Step.
                </h1>

                <p class="hero-description">
                    Practice neural architectures, train models in real-time, and master algorithms with bite-sized, hands-on visual simulations. From regression to Transformers.
                </p>

                <div class="hero-actions">
                    @auth
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                            <span>Open Practice Workspace</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <span>Start Practicing Free</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">
                            <span>Existing Learner</span>
                        </a>
                    @endauth
                </div>

                <div class="hero-stats-row">
                    <div class="stat-item">
                        <h4>40+</h4>
                        <p>Interactive Labs</p>
                    </div>
                    <div class="stat-item">
                        <h4>100%</h4>
                        <p>Code & Visual Practice</p>
                    </div>
                    <div class="stat-item">
                        <h4>5 Tracks</h4>
                        <p>Foundations to LLMs</p>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('images/ml-hero.jpg') }}" alt="Machine Learning Neural Networks Illustration" class="hero-image">
                    
                    <div class="floating-card">
                        <div class="floating-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 14 14"></polyline>
                            </svg>
                        </div>
                        <div class="floating-text">
                            <h5>Daily Practice Track</h5>
                            <p>15 mins/day &bull; Hands-on Nodes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Curriculum / Practice Tracks Section -->
<section class="section" style="background: rgba(15, 23, 42, 0.3); border-top: 1px solid var(--border-subtle); border-bottom: 1px solid var(--border-subtle);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Curriculum Roadmap</span>
            <h2 class="section-title">Structured Learning Tracks</h2>
            <p class="section-subtitle">Progress through gamified modular nodes designed to build intuitive understanding of complex algorithms.</p>
        </div>

        <div class="tracks-grid">
            <!-- Track 1 -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                    </div>
                    <span class="track-level-tag">Track 01</span>
                </div>
                <h3 class="track-title">ML Mathematics & Data</h3>
                <p class="track-desc">Matrix algebra, calculus gradients, probability fundamentals, and data pipeline preparation.</p>
                <div class="track-footer">
                    <span>8 Lessons</span>
                    <span class="track-xp">350 XP</span>
                </div>
            </div>

            <!-- Track 2 -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="18" cy="5" r="3"></circle>
                            <circle cx="6" cy="12" r="3"></circle>
                            <circle cx="18" cy="19" r="3"></circle>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                        </svg>
                    </div>
                    <span class="track-level-tag">Track 02</span>
                </div>
                <h3 class="track-title">Supervised Algorithms</h3>
                <p class="track-desc">Regression models, decision trees, support vector machines, and cost optimization techniques.</p>
                <div class="track-footer">
                    <span>12 Lessons</span>
                    <span class="track-xp">600 XP</span>
                </div>
            </div>

            <!-- Track 3 -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                    </div>
                    <span class="track-level-tag">Track 03</span>
                </div>
                <h3 class="track-title">Deep Neural Networks</h3>
                <p class="track-desc">Perceptrons, forward propagation, activation functions, backpropagation, and loss surfaces.</p>
                <div class="track-footer">
                    <span>14 Lessons</span>
                    <span class="track-xp">850 XP</span>
                </div>
            </div>

            <!-- Track 4 -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <span class="track-level-tag">Track 04</span>
                </div>
                <h3 class="track-title">Transformers & LLMs</h3>
                <p class="track-desc">Multi-head self-attention, positional embeddings, encoder-decoder models, and fine-tuning.</p>
                <div class="track-footer">
                    <span>10 Lessons</span>
                    <span class="track-xp">1,000 XP</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="section">
    <div class="container">
        <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.12), rgba(6, 182, 212, 0.08)); border: 1px solid rgba(16, 185, 129, 0.25); border-radius: var(--radius-lg); padding: 56px 40px; text-align: center; position: relative; overflow: hidden;">
            <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 16px; color: #FFFFFF;">Ready to Build Your Machine Learning Foundation?</h2>
            <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto 32px;">Join developers and students practicing machine learning interactively with bite-sized daily modules.</p>
            
            @auth
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Go to Practice Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create Free Account</a>
            @endauth
        </div>
    </div>
</section>
@endsection
