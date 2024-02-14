<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {

    /* Arrange :: Preparando */
    $user = User::factory()->create();

    actingAs($user);

    /* action :: Agir */
    $request = post(
        route('question.store'),
        [
            'question' => str_repeat('*', 260) . '?',
        ]
    );

    /* Assert :: Verificar */
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);

    assertDatabaseHas(
        'questions',
        [
            'question' => str_repeat('*', 260) . '?',
        ]
    );

});

it('should check if ends with question mark ?', function () {

    /* Arrange :: Preparando */
    $user = User::factory()->create();

    actingAs($user);

    /* action :: Agir */
    $request = post(
        route('question.store'),
        [
            'question' => str_repeat('*', 10),
        ]
    );

    /* Assert :: Verificar */
    $request->assertSessionHasErrors(
        [
            'question' => 'Are you sure that is a question? It is missing a question mark in the end.',
        ]
    );
    assertDatabaseCount('questions', 0);

});

it('shoul have at least 10 characters', function () {

    /* Arrange :: Preparando */
    $user = User::factory()->create();

    actingAs($user);

    /* action :: Agir */
    $request = post(
        route('question.store'),
        [
            'question' => str_repeat('*', 8) . '?',
        ]
    );

    /* Assert :: Verificar */
    $request->assertSessionHasErrors(
        [
            'question' => __(
                'validation.min.string',
                ['min' => 10, 'attribute' => 'question']
            ),
        ]
    );
    assertDatabaseCount('questions', 0);

});
