<?php

use App\Models\{Question, User};
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

it('should list all the question', function () {

    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->count(5)->create();

    actingAs($user);

    // Act
    // act a rota dashboard

    $response = get(route('dashboard'));

    // Assert

    foreach ($question as $q) {
        $response->assertSee($q->question);
    }

});

it('should paginate the result', function () {

    $user = User::factory()->create();
    Question::factory()->count(20)->create();

    actingAs($user);

    get(route('dashboard'))
    ->assertViewHas(
        'questions',
        fn ($value) => $value instanceof LengthAwarePaginator
    );
});
