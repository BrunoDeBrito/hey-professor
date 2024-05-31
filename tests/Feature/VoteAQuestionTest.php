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

it('should note be able to unlike more than 1 time', function () {

    $user = User::factory()->create();

    // Arrange
    $question = Question::factory()->create();

    actingAs($user);

    // Act
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    // Assert
    expect($user->votes()->where('question_id', $question->id)->get())
        ->toHaveCount(1);

});

it('should vote a question', function () {

    $user = User::factory()->create();

    // Arrange
    $question = Question::factory()->create();

    actingAs($user);

    // Act
    post(route('question.unlike', $question))
    ->assertRedirect();

    // Assert
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 0,
        'unlike'      => 1,
    ]);

});

it('should note be able to unlike more than 1 time', function () {

    $user = User::factory()->create();

    // Arrange
    $question = Question::factory()->create();

    actingAs($user);

    // Act
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));

    // Assert
    expect($user->votes()->where('question_id', $question->id)->get())
        ->toHaveCount(1);

});
