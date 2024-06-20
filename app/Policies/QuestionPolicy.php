<?php

namespace App\Policies;

use App\Models\{Question, User};

class QuestionPolicy
{
    /**
     * Determine whether the user can like the model.
     *
     * @param User $user
     * @param Question $question
     * @return boolean
     */
    public function publish(User $user, Question $question): bool
    {
        return $question->createdBy->is($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Question $question
     * @return boolean
     */
    public function update(User $user, Question $question): bool
    {
        return $question->draft && $question->createdBy->is($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Question $question
     * @return boolean
     */
    public function archive(User $user, Question $question): bool
    {
        return $question->createdBy->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Question $question
     * @return boolean
     */
    public function destroy(User $user, Question $question): bool
    {
        return $question->createdBy->is($user);
    }

}
