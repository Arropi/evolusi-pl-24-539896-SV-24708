<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lessonProgress(): HasMany
    {
        return $this->hasMany(UserLessonProgress::class);
    }

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
            ->withPivot('unlocked_at')
            ->withTimestamps();
    }

    public function getTotalXpAttribute(): int
    {
        $lessonXp = (int) $this->lessonProgress()->where('status', 'completed')->sum('xp_earned');
        $achievementXp = (int) $this->achievements()->sum('xp_reward');

        return $lessonXp + $achievementXp;
    }

    public function getCompletedLessonsCountAttribute(): int
    {
        return $this->lessonProgress()->where('status', 'completed')->count();
    }

    public function getOverallProgressPercentageAttribute(): int
    {
        $totalLessons = Lesson::count();
        if ($totalLessons === 0) {
            return 0;
        }

        return (int) round(($this->completed_lessons_count / $totalLessons) * 100);
    }

    public function getLevelAttribute(): int
    {
        // 0-199 XP: Level 1, 200-399 XP: Level 2, etc.
        return 1 + (int) floor($this->total_xp / 200);
    }
}
