<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\UserLessonProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LessonController extends Controller
{
    /**
     * Display the specified interactive lesson lab.
     */
    public function show(string $slug): View|RedirectResponse
    {
        $user = Auth::user();
        $lesson = Lesson::with('track')->where('slug', $slug)->firstOrFail();

        if (! $lesson->isUnlockedFor($user->id)) {
            return redirect()->route('home')->with('warning', 'Modul ini masih terkunci. Silakan selesaikan modul sebelumnya terlebih dahulu.');
        }

        $isCompleted = $lesson->isCompletedBy($user->id);

        // Fetch adjacent lessons
        $nextLesson = Lesson::where('track_id', $lesson->track_id)
            ->where('order', '>', $lesson->order)
            ->orderBy('order')
            ->first();

        $prevLesson = Lesson::where('track_id', $lesson->track_id)
            ->where('order', '<', $lesson->order)
            ->orderByDesc('order')
            ->first();

        return view('lessons.show', compact('lesson', 'isCompleted', 'nextLesson', 'prevLesson', 'user'));
    }

    /**
     * Validate the challenge answer and record progress.
     */
    public function complete(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'selected_option' => 'required|integer',
        ]);

        $user = Auth::user();
        $lesson = Lesson::findOrFail($id);

        if (! $lesson->isUnlockedFor($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Modul ini masih terkunci.',
            ], 403);
        }

        $selectedIndex = (int) $request->input('selected_option');

        if ($selectedIndex !== $lesson->challenge_correct_index) {
            return response()->json([
                'success' => false,
                'message' => 'Jawaban belum tepat. Coba telaah kembali analogi logika dan konsep library di atas!',
                'explanation' => null,
            ]);
        }

        // Check if already completed before
        $alreadyCompleted = $lesson->isCompletedBy($user->id);

        // Record progress in database
        UserLessonProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'status' => 'completed',
                'xp_earned' => $lesson->xp_reward,
                'completed_at' => now(),
            ]
        );

        // Check and unlock achievements
        $unlockedAchievementName = null;
        if ($lesson->slug === 'fondasi-data-numpy-vektorisasi') {
            $noviceBadge = Achievement::where('code', 'matrix_novice')->first();
            if ($noviceBadge && ! $user->achievements()->where('achievement_id', $noviceBadge->id)->exists()) {
                $user->achievements()->attach($noviceBadge->id, ['unlocked_at' => now()]);
                $unlockedAchievementName = $noviceBadge->title;
            }
        }

        // Check if all lessons in track 1 completed
        $track1LessonsCount = Lesson::where('track_id', $lesson->track_id)->count();
        $completedInTrackCount = UserLessonProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', Lesson::where('track_id', $lesson->track_id)->pluck('id'))
            ->where('status', 'completed')
            ->count();

        if ($track1LessonsCount > 0 && $completedInTrackCount >= $track1LessonsCount) {
            $gradientBadge = Achievement::where('code', 'gradient_conqueror')->first();
            if ($gradientBadge && ! $user->achievements()->where('achievement_id', $gradientBadge->id)->exists()) {
                $user->achievements()->attach($gradientBadge->id, ['unlocked_at' => now()]);
                $unlockedAchievementName = $gradientBadge->title;
            }
        }

        // Determine next lesson
        $nextLesson = Lesson::where('track_id', $lesson->track_id)
            ->where('order', '>', $lesson->order)
            ->orderBy('order')
            ->first();

        // Refresh user model for updated total_xp
        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => $alreadyCompleted
                ? 'Kuis berhasil diselesaikan kembali! Pemahaman Anda semakin matang.'
                : 'Luar biasa! Modul berhasil diselesaikan dan dicatat ke database.',
            'xp_earned' => $alreadyCompleted ? 0 : $lesson->xp_reward,
            'total_xp' => $user->total_xp,
            'explanation' => $lesson->challenge_explanation,
            'achievement_unlocked' => $unlockedAchievementName,
            'next_lesson_url' => $nextLesson ? route('lessons.show', $nextLesson->slug) : route('home'),
        ]);
    }
}
