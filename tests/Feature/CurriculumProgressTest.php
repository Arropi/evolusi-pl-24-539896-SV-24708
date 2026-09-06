<?php

namespace Tests\Feature;

use App\Models\Lesson;
use App\Models\User;
use Database\Seeders\MachineLearningCurriculumSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurriculumProgressTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(MachineLearningCurriculumSeeder::class);
    }

    public function test_authenticated_user_starts_with_zero_progress_and_can_view_home(): void
    {
        $user = User::factory()->create([
            'name' => 'Data Scientist Muda',
            'email' => 'datascientist@example.com',
        ]);

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('0 XP');
        $response->assertSee('Level 1');
        $response->assertSee('Tensor Novice');
        $response->assertSee('0 / 5');
        $response->assertSee('Fondasi Data: Mengenal NumPy &amp; Vektorisasi', false);
        $response->assertSee('Mulai Praktik');
        $response->assertSee('ML Skill Mastery Matrix (5 Pilar AI)');
    }

    public function test_user_can_access_first_unlocked_lesson(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::where('slug', 'fondasi-data-numpy-vektorisasi')->firstOrFail();

        $response = $this->actingAs($user)->get(route('lessons.show', $lesson->slug));

        $response->assertStatus(200);
        $response->assertSee($lesson->title);
        $response->assertSee('Kotak Bento Bersekat Presisi');
        $response->assertSee('Kantong Belanja Plastik Acak');
        $response->assertSee('Vektorisasi SIMD');
        $response->assertSee('np.dot');
        $response->assertSee('Tantangan Evaluasi Lab');
    }

    public function test_user_cannot_access_locked_second_lesson_before_completing_first(): void
    {
        $user = User::factory()->create();
        $lesson2 = Lesson::where('slug', 'manipulasi-matriks-reshaping-broadcasting')->firstOrFail();

        $response = $this->actingAs($user)->get(route('lessons.show', $lesson2->slug));

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('warning');
    }

    public function test_user_can_submit_correct_quiz_answer_and_gain_xp_and_achievement(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::where('slug', 'fondasi-data-numpy-vektorisasi')->firstOrFail();

        $response = $this->actingAs($user)->postJson(route('lessons.complete', $lesson->id), [
            'selected_option' => 0,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'xp_earned' => 100,
            'achievement_unlocked' => 'Matrix Novice',
        ]);

        $this->assertDatabaseHas('user_lesson_progress', [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'status' => 'completed',
            'xp_earned' => 100,
        ]);

        $this->assertDatabaseHas('user_achievements', [
            'user_id' => $user->id,
        ]);

        // User total XP should be 100 (lesson) + 50 (Matrix Novice badge) = 150
        $user->refresh();
        $this->assertEquals(150, $user->total_xp);
        $this->assertEquals(1, $user->completed_lessons_count);

        // Lesson 2 should now be unlocked for this user
        $lesson2 = Lesson::where('slug', 'manipulasi-matriks-reshaping-broadcasting')->firstOrFail();
        $this->assertTrue($lesson2->isUnlockedFor($user->id));

        // User can now visit Lesson 2
        $responseLesson2 = $this->actingAs($user)->get(route('lessons.show', $lesson2->slug));
        $responseLesson2->assertStatus(200);
    }

    public function test_wrong_quiz_answer_does_not_award_xp_or_progress(): void
    {
        $user = User::factory()->create();
        $lesson = Lesson::where('slug', 'fondasi-data-numpy-vektorisasi')->firstOrFail();

        $response = $this->actingAs($user)->postJson(route('lessons.complete', $lesson->id), [
            'selected_option' => 2, // Wrong index
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => false,
        ]);

        $this->assertDatabaseMissing('user_lesson_progress', [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
        ]);

        $user->refresh();
        $this->assertEquals(0, $user->total_xp);
    }
}
