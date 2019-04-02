<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $modelQuestion;
    protected $modelUser;
    public function __construct(Question $question, User $user)
    {
        $this->modelQuestion = $question;
        $this->modelUser  = $user;
    }

    public function index()
    {
        $newUsers = $this->modelUser->getNewUser();
        return view('admin.index', compact('newUsers'));
    }

    public function getQuestionToApprove()
    {
        $questions = $this->modelQuestion->getQuestionToApprove();
        return view('admin.question_dashboard', compact('questions'));
    }

    public function detailQuestionApprove($id)
    {
        $question = $this->modelQuestion->getQuestionDetail($id);
        return view('admin.question_detail', compact('question'));
    }

    public function verifyQuestion(Request $request)
    {
        $input = $request->all();

        $result = $this->modelQuestion->verifyQuestion($input);
        if ($result) {
            return redirect()->back()->with('success', 'Successful save status.');
        } else {
            return redirect()->back()->with('error', 'Whoops!! Something is wrong.');
        }
    }
}
