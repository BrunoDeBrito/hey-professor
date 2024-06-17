<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;

/**
 * Controller responsible for the dashboard
 *
 * @author Bruno De Brito <bruno@gmail.com>
 * @since 04/06/2024
 * @version 1.0.0
 */
class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $data = [
            'questions' => Question::withSum('votes', 'like')
            ->withSum('votes', 'unlike')
            ->paginate(5),
        ];

        return view('dashboard', $data);
    }
}
