<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Poll;
use App\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PollController extends Controller
{
<<<<<<< HEAD
    public function __construct(){
        $this->middleware('auth')->except(['show','vote']);
=======
    public function index()
    {
        $polls = Poll::public()->paginate(5);
        return view('polls.index', compact('polls'));
>>>>>>> ac3f024b200e41e9804077f898f8db4541728101
    }

    public function show(Poll $poll)
    {
        $userVotes  = $poll->votes()->where('user_id', Auth::user()->id)->count();
        $totalVotes = $poll->votes()->count();

<<<<<<< HEAD
        return view('polls.index', compact(['polls']));
    }

    public function show($poll){
        $pollObj = Poll::where('code', $poll)->firstOrFail();

        $userVotes = $pollObj->votes()->where('user_id', Auth::user()->id)->count();
        $totalVotes = $pollObj->votes()->count();

        return view('polls.show', compact(['pollObj','userVotes','totalVotes']));
=======
        return view('polls.show', compact('poll', 'userVotes', 'totalVotes'));
>>>>>>> ac3f024b200e41e9804077f898f8db4541728101
    }

    public function vote(Poll $poll, VoteRequest $request)
    {
        $options = $request->poll_option;

        Vote::where('user_id', Auth::user()->id)
            ->where('poll_id', $poll->id)
            ->delete();

        foreach ($options as $option) {
            Vote::create([
                'user_id'   => Auth::user()->id,
                'poll_id'   => $poll->id,
                'option_id' => $option
            ]);
        }

<<<<<<< HEAD
        Session::flash('status', 'You successfully voted in '.$pollObj->name.'.');


        return redirect(action('PollController@show', $poll));
=======
        Session::flash('status', 'You successfully voted in ' . $poll->name . '.');
        return redirect(action('PollController@vote', $poll));
>>>>>>> ac3f024b200e41e9804077f898f8db4541728101
    }
}
