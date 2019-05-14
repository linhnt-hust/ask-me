<?php

namespace App\Http\View\Composers;

use App\Models\Comment;
use App\Models\Question;
use App\Models\Tag;
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
    protected $modalTag;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(
        Question $question,
        Comment $comment,
        Tag $tag
    ){
        $this->modelQuestion = $question;
        $this->modelComment = $comment;
        $this->modalTag = $tag;
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
        $tags = $this->modelQuestion->getPopularTags();
        $view->with(compact('recentQuestions', 'comments', 'tags'));
    }
}
