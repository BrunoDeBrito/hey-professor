<?php

namespace App\Policies;

use App\Models\{Question, User};

/**
 * Policy responsible for managing the publication of a question
 *
 * @author Bruno De Brito <bruno@gmail.com>
 * @since 05/06/2024
 * @version 1.0.0
 */
class QestionPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function publish(User $user, Question $question): bool
    {
        return $question->createdBy->is($user);
    }
}
