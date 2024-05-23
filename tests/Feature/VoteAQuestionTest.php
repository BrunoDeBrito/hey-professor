<?php
use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should vote a question', function () {

    $user = User::factory()->create();

    // Arrange
    $question = Question::factory()->create();

    actingAs($user);

    // Act
    post(route('question.like', $question))
    ->assertRedirect();

    // Assert
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);

});
