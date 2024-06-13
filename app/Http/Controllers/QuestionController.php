<?php

namespace App\Http\Controllers;

use App\Models\Question;

use Closure;
use Illuminate\Contracts\View\View;
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
     * Method responsible for listing all questions
     *
     * @return View
     */
    public function index(): View
    {
        $data = [
            'questions' => user()->questions,
        ];

        return view('question.index', $data);
    }

    /**
     * Método responsável por criar uma nova pergunta
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
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

        user()->questions()
            ->create([
                'question' => request()->question,
                'draft'    => true,
            ]);

        return back();

    }

    public function edit(Question $question): View
    {
        $this->authorize('update', $question);

        return view('question.edit', compact('question'));
    }

    public function update(Question $question): RedirectResponse
    {

        $this->authorize('update', $question);

        $question->question = request()->question;
        $question->save();

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {

        $this->authorize('destroy', $question);

        $question->delete();

        return back();

    }
}
