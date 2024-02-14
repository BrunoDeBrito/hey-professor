<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request, Response};

/**
 * Controller Responsável por gerenciar as perguntas
 *
 * @author Bruno De Brito <bruno@gmail.com>
 * @since 14/02/2024
 * @version 1.0.0
 */
class QuestionController extends Controller
{
    /**
     * Método responsável por criar uma nova pergunta
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $attributes = request()->validate([
            'question' => ['required'],
        ]);

        Question::query()->create($attributes);

        return to_route('dashboard');

    }
}
