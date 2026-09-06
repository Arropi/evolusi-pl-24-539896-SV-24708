@extends('layouts.app')

@section('title', $lesson->title . ' - MLPath Lab')

@section('content')
<div class="container" style="max-width: 1040px; padding-bottom: 60px;">
    <!-- Breadcrumb and Lab Navigation Top Bar -->
    <div class="lesson-nav-bar">
        <a href="{{ route('home') }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 0.85rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Kembali ke Roadmap</span>
        </a>

        <div style="display: flex; align-items: center; gap: 12px;">
            <span class="lesson-meta-badge">{{ $lesson->track->title }}</span>
            <span class="stat-pill-data" style="font-family: var(--font-mono); color: var(--color-emerald); font-weight: 700;">
                +{{ $lesson->xp_reward }} XP
            </span>
        </div>
    </div>

    <!-- Lesson Hero Header -->
    <div style="margin-bottom: 40px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
            <span style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; color: var(--color-cyan); letter-spacing: 0.05em;">
                Modul Lab {{ $lesson->order }} &bull; Estimasi {{ $lesson->estimated_minutes }} Menit
            </span>
            @if ($isCompleted)
                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; border-radius: var(--radius-full); background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: var(--color-emerald); font-size: 0.75rem; font-weight: 700;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Tuntas
                </span>
            @endif
        </div>
        <h1 class="lesson-title-hero">{{ $lesson->title }}</h1>
        <p class="lesson-summary-lead">{{ $lesson->summary }}</p>
    </div>

    <!-- Section 1: Real-World Logic Analogy -->
    <section class="lesson-card-section">
        <div class="section-label-bar">
            <div class="indicator"></div>
            <h3>1. Pengibaratan Logika: Mengapa Komputer Membutuhkan NumPy</h3>
        </div>

        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.65; margin-bottom: 20px;">
            Sebelum menyentuh baris kode kecerdasan buatan, kita perlu memahami bagaimana prosesor komputer (CPU & GPU) mengelola memori ketika mengolah data berukuran jutaan sampel.
        </p>

        <!-- Visual Analogy Grid 1: Memory Layout -->
        <div class="analogy-container">
            <div class="analogy-card">
                <div class="analogy-card-header">
                    <div class="analogy-icon slow">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <div>
                        <h4 class="analogy-card-title">List Standar Python</h4>
                        <span style="font-size: 0.72rem; color: var(--color-rose); font-weight: 600;">Kantong Belanja Plastik Acak</span>
                    </div>
                </div>
                <div class="analogy-card-body">
                    List bawaan Python menyimpan berbagai objek di alamat memori terpisah yang terpencar (<em>pointer-based</em>). Setiap iterasi mengharuskan prosesor memeriksa tipe data satu per satu, menyebabkan lompatan memori yang lambat dan boros instruksi CPU.
                </div>
            </div>

            <div class="analogy-card highlight">
                <div class="analogy-card-header">
                    <div class="analogy-icon fast">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <div>
                        <h4 class="analogy-card-title">NumPy ndarray</h4>
                        <span style="font-size: 0.72rem; color: var(--color-emerald); font-weight: 600;">Kotak Bento Bersekat Presisi</span>
                    </div>
                </div>
                <div class="analogy-card-body">
                    Array NumPy menyimpan data bertipe seragam (misal: <code>float32</code>) dalam satu blok memori berurutan (<em>contiguous buffer</em>). CPU/GPU dapat membaca ribuan angka sekaligus dalam satu tarikan <em>cache line</em> berkecepatan tinggi.
                </div>
            </div>
        </div>

        <!-- Analogy 2: SIMD Computation -->
        <div style="background: rgba(8, 12, 20, 0.7); border: 1px solid var(--border-subtle); border-radius: var(--radius-sm); padding: 22px; margin-top: 20px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--color-cyan);">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                <h4 style="font-size: 1rem; font-weight: 700; color: var(--text-main);">Analogi Pabrik: Pekerja Manual vs Mesin Press Hidrolik (Vektorisasi SIMD)</h4>
            </div>
            <p style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.6;">
                Jika Anda memiliki <strong>1.000.000 kaleng</strong> yang harus dipipihkan:
                <br>&bull; Perulangan <code>for loop</code> Python seperti menyuruh 1 pekerja mengetuk kaleng satu demi satu dengan palu tangan secara sekuensial.
                <br>&bull; <strong>Vektorisasi NumPy</strong> seperti meletakkan seluruh baris kaleng di bawah mesin press hidrolik raksasa (instruksi perangkat keras <em>SIMD - Single Instruction, Multiple Data</em>), meratakan ribuan angka secara simultan dalam satu siklus clock prosesor.
            </p>
        </div>
    </section>

    <!-- Section 2: Library Deep Dive & Tensor Dimensions -->
    <section class="lesson-card-section">
        <div class="section-label-bar">
            <div class="indicator"></div>
            <h3>2. Bedah Library: Dimensi Tensor & Arsitektur Data AI</h3>
        </div>

        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.65; margin-bottom: 20px;">
            {{ $lesson->library_why }}
        </p>

        <h4 style="font-size: 1.05rem; font-weight: 700; margin: 24px 0 12px; color: var(--text-main);">Hierarki Struktur Tensor dari 0D hingga 4D:</h4>

        <div class="tensor-grid">
            @if (is_array($lesson->library_concepts))
                @foreach ($lesson->library_concepts as $concept)
                    <div class="tensor-box">
                        <div class="tensor-box-header">
                            <h5 class="tensor-title">{{ $concept['name'] }}</h5>
                            @if (isset($concept['symbol']))
                                <span class="tensor-math-tag">{{ $concept['symbol'] }}</span>
                            @endif
                        </div>
                        <p class="tensor-desc">{{ $concept['desc'] }}</p>
                        @if (isset($concept['example']))
                            <div class="tensor-code-preview">{{ $concept['example'] }}</div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <!-- Section 3: Live Code Sandbox Comparison -->
    <section class="lesson-card-section">
        <div class="section-label-bar">
            <div class="indicator"></div>
            <h3>3. Praktik Kode: Vektorisasi Dot Product ($y = W \cdot X + b$)</h3>
        </div>

        <p style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.65; margin-bottom: 16px;">
            Berikut adalah komparasi komputasi perhitungan forward pass neuron buatan. Perhatikan bagaimana <code>np.dot()</code> menggantikan perulangan lambat dengan aljabar linier teroptimasi:
        </p>

        <div class="code-sandbox-wrapper">
            <div class="code-sandbox-topbar">
                <div class="code-lang-pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                    </svg>
                    <span>Python 3 &bull; NumPy Vectorization Sandbox</span>
                </div>
                <button type="button" class="copy-btn" onclick="copySnippet(this, 'main-code-snippet')">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                    </svg>
                    <span>Copy Code</span>
                </button>
            </div>
            <pre class="code-editor-pre" id="main-code-snippet">{{ $lesson->code_example }}</pre>
        </div>
    </section>

    <!-- Section 4: Interactive Lab Challenge / Quiz -->
    <section class="lesson-card-section" style="border-color: rgba(16, 185, 129, 0.35);">
        <div class="quiz-wrapper">
            <div class="quiz-header">
                <div class="quiz-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                    <span>Tantangan Evaluasi Lab</span>
                </div>
                <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--color-emerald); font-weight: 700;">
                    Hadiah: +{{ $lesson->xp_reward }} XP
                </span>
            </div>

            <p class="quiz-question-text">{{ $lesson->challenge_question }}</p>

            <form id="challenge-form">
                @csrf
                <div class="quiz-options-list">
                    @if (is_array($lesson->challenge_options))
                        @foreach ($lesson->challenge_options as $index => $option)
                            <label class="quiz-option-item" id="option-item-{{ $index }}">
                                <input type="radio" name="selected_option" value="{{ $index }}" class="quiz-radio" onchange="highlightOption({{ $index }})">
                                <span class="quiz-option-label">{{ $option }}</span>
                            </label>
                        @endforeach
                    @endif
                </div>

                <!-- Dynamic Feedback Box -->
                <div id="feedback-container" class="quiz-feedback-box"></div>

                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; margin-top: 24px;">
                    <button type="submit" id="btn-submit-challenge" class="btn btn-primary btn-lg" style="min-width: 220px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Kirim Jawaban Lab</span>
                    </button>

                    <div id="post-actions" style="display: none; align-items: center; gap: 12px;">
                        @if ($nextLesson)
                            <a href="{{ route('lessons.show', $nextLesson->slug) }}" class="btn btn-primary" style="padding: 12px 22px;">
                                <span>Lanjut ke Modul {{ $nextLesson->order }}</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-secondary" style="padding: 12px 22px;">
                                <span>Kembali ke Dashboard</span>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    function highlightOption(selectedIndex) {
        document.querySelectorAll('.quiz-option-item').forEach((item, index) => {
            if (index === selectedIndex) {
                item.classList.add('selected');
            } else {
                item.classList.remove('selected');
            }
        });
    }

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

    document.getElementById('challenge-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const selectedOption = document.querySelector('input[name="selected_option"]:checked');
        const feedbackContainer = document.getElementById('feedback-container');
        const submitBtn = document.getElementById('btn-submit-challenge');
        const postActions = document.getElementById('post-actions');

        if (!selectedOption) {
            feedbackContainer.className = 'quiz-feedback-box is-error';
            feedbackContainer.innerHTML = '<strong>Pilih salah satu jawaban:</strong> Silakan klik salah satu opsi sebelum mengirimkan evaluasi.';
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;">
                <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                <path d="M12 2a10 10 0 0 1 10 10"></path>
            </svg>
            <span>Memverifikasi Komputasi...</span>
        `;

        try {
            const response = await fetch("{{ route('lessons.complete', $lesson->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    selected_option: parseInt(selectedOption.value)
                })
            });

            const data = await response.json();

            if (data.success) {
                feedbackContainer.className = 'quiz-feedback-box is-success';
                let content = `<strong>Jawaban Benar!</strong> ${data.message}`;
                if (data.explanation) {
                    content += `<div style="margin-top: 8px; font-size: 0.88rem; color: #D1FAE5;">${data.explanation}</div>`;
                }
                if (data.achievement_unlocked) {
                    content += `<div style="margin-top: 10px; padding: 8px 12px; background: rgba(16, 185, 129, 0.2); border-radius: 6px; font-weight: 700; color: #FFFFFF; display: flex; align-items: center; gap: 8px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        Medali Baru Terbuka: ${data.achievement_unlocked}!
                    </div>`;
                }
                feedbackContainer.innerHTML = content;
                
                submitBtn.style.display = 'none';
                postActions.style.display = 'flex';
            } else {
                feedbackContainer.className = 'quiz-feedback-box is-error';
                feedbackContainer.innerHTML = `<strong>Belum Tepat:</strong> ${data.message}`;
                submitBtn.disabled = false;
                submitBtn.innerHTML = `
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>Coba Kirim Lagi</span>
                `;
            }
        } catch (error) {
            feedbackContainer.className = 'quiz-feedback-box is-error';
            feedbackContainer.innerHTML = '<strong>Terjadi Kendala:</strong> Gagal menghubungkan ke server. Silakan coba beberapa saat lagi.';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Kirim Jawaban Lab</span>';
        }
    });
</script>
<style>
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
@endpush
