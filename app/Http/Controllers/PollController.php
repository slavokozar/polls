<?php

namespace App\Http\Controllers;

use App\Poll;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PollController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show','vode']);
    }

    public function index(){
        $polls = Poll::where('public', true)->get();

        return view('polls.index', compact(['polls']));
    }

    public function show($poll){
        $pollObj = Poll::where('code', $poll)->firstOrFail();

        $userVotes = $pollObj->votes()->where('user_id', Auth::user()->id)->count();
        $totalVotes = $pollObj->votes()->count();

        return view('polls.show', compact(['pollObj','userVotes','totalVotes']));
    }

    public function vote($poll, Request $request){
        $pollObj = Poll::where('code', $poll)->firstOrFail();

        $options =  $request->input('poll_option');

        Vote::where('user_id', Auth::user()->id)
            ->where('poll_id', $pollObj->id)
            ->delete();

        foreach($options as $option){
            Vote::create([
                'user_id' => Auth::user()->id,
                'poll_id' => $pollObj->id,
                'option_id' => $option
            ]);
        }

        Session::flash('status', 'You successfully voted in '.$pollObj->name.'.');


        return redirect(action('PollController@vote', $poll));
    }
}
