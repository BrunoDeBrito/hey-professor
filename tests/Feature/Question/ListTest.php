<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all the question', function () {

    // Arrange
    // Criar algumas Perguntas
    $user     = User::factory()->create();
    $question = Question::factory()->count(5)->create();

    actingAs($user);

    // Act
    // Acessar a rota dashboard

    $response = get(route('dashboard'));

    // Assert
    // Verificar se a lista de perguntas está sendo exibida

    foreach ($question as $q) {
        $response->assertSee($q->question);
    }

});
