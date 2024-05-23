<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\{RedirectResponse};

/**
 * Like Controller
 *
 * @author Bruno De Brito <bruno@gmail.com>
 * @since 21/05/2024
 * @version 1.0.0
 */
class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {

        // dd($question->toArray());

        return back();
    }

}
