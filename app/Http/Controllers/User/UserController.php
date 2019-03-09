<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Question;

class UserController extends Controller
{
    protected $modelQuestion;
    public function __construct(Question $question)
    {
        $this->modelQuestion = $question;
    }

    public function userQuestion()
    {
        $user = Auth::user();
        $userQuestions = $this->modelQuestion->getUserQuestion($user->id);
        return view('user.question.user_question', compact('user', 'userQuestions'));
    }

    public function questionDetail($id)
    {
        $user = Auth::user();
        $questions = $this->modelQuestion->getQuestionDetail($id);
        return view('user.question.question_detail', compact('questions', 'user'));
    }
}
