<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

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
            'questions' => Question::query()
            ->when(request()->has('search'), function (Builder $query) {
                $query->where('question', 'like', '%' . request()->search . '%');

            })
            ->withSum('votes', 'like')
                ->withSum('votes', 'unlike')
                ->orderByRaw('
                    case when (SELECT sum(votes.like) FROM votes WHERE questions.id = votes.question_id) is null then 0 else (SELECT sum(votes.like) FROM votes WHERE questions.id = votes.question_id) end desc,
                    case when (SELECT sum(votes.unlike) FROM votes WHERE questions.id = votes.question_id) is null then 0 else (SELECT sum(votes.unlike) FROM votes WHERE questions.id = votes.question_id) end
                ')
            ->paginate(5),

        ];

        return view('dashboard', $data);
    }
}
