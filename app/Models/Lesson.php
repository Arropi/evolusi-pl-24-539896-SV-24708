<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'title',
        'slug',
        'order',
        'xp_reward',
        'estimated_minutes',
        'summary',
        'analogy_title',
        'analogy_content',
        'library_name',
        'library_why',
        'library_concepts',
        'code_example',
        'challenge_question',
        'challenge_options',
        'challenge_correct_index',
        'challenge_explanation',
    ];

    protected function casts(): array
    {
        return [
            'library_concepts' => 'array',
            'challenge_options' => 'array',
            'challenge_correct_index' => 'integer',
            'xp_reward' => 'integer',
            'estimated_minutes' => 'integer',
            'order' => 'integer',
        ];
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(UserLessonProgress::class);
    }

    public function isCompletedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->progress()
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->exists();
    }

    public function isUnlockedFor(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        // The very first lesson is always unlocked
        if ($this->order === 1 && ($this->track->order ?? 1) === 1) {
            return true;
        }

        // Check if the immediately preceding lesson in the same track is completed
        $previousInTrack = self::where('track_id', $this->track_id)
            ->where('order', $this->order - 1)
            ->first();

        if ($previousInTrack) {
            return $previousInTrack->isCompletedBy($userId);
        }

        // If this is the first lesson of a subsequent track, check if the previous track's last lesson was completed
        $previousTrack = Track::where('order', ($this->track->order ?? 1) - 1)->first();
        if ($previousTrack) {
            $lastLessonPrevTrack = $previousTrack->lessons()->orderByDesc('order')->first();
            if ($lastLessonPrevTrack) {
                return $lastLessonPrevTrack->isCompletedBy($userId);
            }
        }

        return false;
    }
}
