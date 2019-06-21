<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Poll;
use App\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PollController extends Controller
{

    public function index()
    {
        $polls = Poll::public()->paginate(5);
        return view('polls.index', compact('polls'));

    }

    public function show(Poll $poll)
    {
        $userVotes  = $poll->votes()->where('user_id', Auth::user()->id)->count();
        $totalVotes = $poll->votes()->count();

        return view('polls.show', compact('poll', 'userVotes', 'totalVotes'));
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

        Session::flash('status', 'You successfully voted in ' . $poll->name . '.');
        return redirect(action('PollController@vote', $poll));
    }
}
