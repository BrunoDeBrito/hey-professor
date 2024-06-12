<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question};
use Illuminate\Http\{RedirectResponse};

/**
 * Controller responsible for liki a question
 *
 * @author Bruno De Brito <bruno@gmail.com>
 * @since 21/05/2024
 * @version 1.0.0
 */
class LikeController extends Controller
{
    /**
     * Like a question
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function __invoke(Question $question): RedirectResponse
    {
        user()->like($question);

        return back();
    }

}
