<?php

namespace App\Http\Controllers;

use App\Models\Question;

use Closure;
use Illuminate\Http\{RedirectResponse, Request};

/**
 * Controller responsible for the questions
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
            'question' => [
                'required',
                'min:10',
                function ($attribute, $value, Closure $fail) {
                    if (substr($value, -1) !== '?') {
                        $fail('Are you sure that is a question? It is missing a question mark in the end.');
                    }
                },
            ],
            'draft' => 'boolean',
        ]);

        Question::query()
            ->create([
                'question' => $attributes['question'],
                'draft'    => true,
            ]);

        return to_route('dashboard');

    }
}
