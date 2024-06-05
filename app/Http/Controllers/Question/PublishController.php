<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

/**
 * Controller responsible for publishing a question
 *
 * @author Bruno De Brito <bruno@gmail.com>
 * @since 04/06/2024
 * @version 1.0.0
 */
class PublishController extends Controller
{
    /**
     * Publish a question
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function __invoke(Question $question): RedirectResponse
    {

        $this->authorize('publish', $question);

        $question->update(['draft' => false]);

        return back();
    }
}
