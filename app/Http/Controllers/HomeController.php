<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the authenticated home dashboard with real database progress.
     */
    public function index(): View
    {
        $user = Auth::user();

        // 1. Fetch Tracks with Lessons in ordered sequence
        $tracks = Track::with(['lessons' => function ($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();

        // Map status for each lesson for the current user
        $tracks->each(function ($track) use ($user) {
            $track->lessons->each(function ($lesson) use ($user) {
                $lesson->is_completed = $lesson->isCompletedBy($user->id);
                $lesson->is_unlocked = $lesson->isUnlockedFor($user->id);
            });
        });

        // 2. Fetch Achievements & annotate with unlock state
        $allAchievements = Achievement::orderBy('id')->get();
        $unlockedAchievementIds = $user->achievements()->pluck('achievements.id')->toArray();

        $achievements = $allAchievements->map(function ($ach) use ($unlockedAchievementIds) {
            $ach->is_unlocked = in_array($ach->id, $unlockedAchievementIds);

            return $ach;
        });

        // 3. Compute 5 Pillars of ML Skill Mastery Matrix based on completed lessons
        $completedLessonSlugs = $user->lessonProgress()
            ->where('status', 'completed')
            ->join('lessons', 'user_lesson_progress.lesson_id', '=', 'lessons.id')
            ->pluck('lessons.slug')
            ->toArray();

        $skillMatrix = [
            [
                'pillar' => 'Data & NumPy Foundations',
                'description' => 'Vektorisasi SIMD, Tensor Memory, & Operasi Array',
                'percentage' => in_array('fondasi-data-numpy-vektorisasi', $completedLessonSlugs) ? (in_array('manipulasi-matriks-reshaping-broadcasting', $completedLessonSlugs) ? 100 : 50) : 0,
                'tag' => 'Core Math',
            ],
            [
                'pillar' => 'Supervised Learning',
                'description' => 'Regresi, Klasifikasi, & Evaluasi Metrik Loss',
                'percentage' => 0,
                'tag' => 'Algorithms',
            ],
            [
                'pillar' => 'Neural Networks & Backpropagation',
                'description' => 'Perceptron, Fungsi Aktivasi, & Gradient Descent',
                'percentage' => in_array('membangun-neuron-perceptron-dari-nol', $completedLessonSlugs) ? 100 : 0,
                'tag' => 'Deep Learning',
            ],
            [
                'pillar' => 'Computer Vision (CNN)',
                'description' => 'Feature Extraction, Convolutions, & Pooling',
                'percentage' => 0,
                'tag' => 'Vision',
            ],
            [
                'pillar' => 'Transformers & LLM',
                'description' => 'Self-Attention, Positional Encoding, & Generative AI',
                'percentage' => 0,
                'tag' => 'Modern AI',
            ],
        ];

        // 4. Quick ML Formula & Syntax Cheat Sheet items
        $cheatSheetItems = [
            [
                'title' => 'Dot Product (Forward Pass)',
                'code' => 'y = np.dot(W, x) + b',
                'desc' => 'Perkalian vektor bobot dan fitur ditambah bias linier.',
            ],
            [
                'title' => 'Tensor Reshape & Flatten',
                'code' => 'X_flat = X.reshape(X.shape[0], -1)',
                'desc' => 'Meratakan tensor multi-dimensi menjadi matriks 2D untuk input layer.',
            ],
            [
                'title' => 'Feature Standardization (Z-Score)',
                'code' => 'X_norm = (X - np.mean(X, axis=0)) / np.std(X, axis=0)',
                'desc' => 'Normalisasi fitur agar mean = 0 dan variansi = 1 untuk stabilitas gradien.',
            ],
            [
                'title' => 'Sigmoid Activation Function',
                'code' => 'def sigmoid(z):\n    return 1 / (1 + np.exp(-z))',
                'desc' => 'Memetakan nilai skalar ke probabilitas kontinu [0, 1].',
            ],
        ];

        // 5. User progress stats
        $totalXp = $user->total_xp;
        $level = $user->level;
        $completedLessonsCount = $user->completed_lessons_count;
        $totalLessonsCount = Lesson::count();
        $progressPercentage = $user->overall_progress_percentage;

        return view('home', compact(
            'user',
            'tracks',
            'achievements',
            'skillMatrix',
            'cheatSheetItems',
            'totalXp',
            'level',
            'completedLessonsCount',
            'totalLessonsCount',
            'progressPercentage'
        ));
    }
}
