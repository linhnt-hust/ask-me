<?php

namespace App\Http\View\Composers;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\View\View;

class AsideBarComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $modelQuestion;
    protected $modelComment;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct( Question $question, Comment $comment)
    {
        $this->modelQuestion = $question;
        $this->modelComment = $comment;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $recentQuestions = $this->modelQuestion->getRecentQuestions();
        $comments = $this->modelComment->getTotalComment();
        $user = Auth::user();
//        $view->with('recentQuestion', $recentQuestions)->with('user', $user)->with('comments', $comments);
        $view->with(compact('recentQuestions','user'));
    }
}
