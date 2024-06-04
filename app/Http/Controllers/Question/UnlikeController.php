<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\{RedirectResponse};

/**
 * Controller responsible for unliking a question
 *
 * @author Bruno De Brito <bruno@gmail.com>
 * @since 04/06/2024
 * @version 1.0.0
 */
class UnlikeController extends Controller
{
    /**
     * Like a question
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function __invoke(Question $question): RedirectResponse
    {
        user()->unlike($question);

        return back();
    }

}
