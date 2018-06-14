<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePollRequest;
use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PollController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            return optional($request->route('poll'))->user_id == Auth::user()->id ?
                $next($request) :
                abort(403);
        })->except(['index', 'create', 'store']);
    }

    public function index()
    {
        $polls = Auth::user()->polls;
        return view('management.polls.index', compact('polls'));
    }

    public function create()
    {
        return view('management.polls.create');
    }

    public function store(CreatePollRequest $request)
    {
        $poll = Poll::create([
            'user_id'       => Auth::user()->id,
            'name'          => $request->name,
            'code'          => uniqid(),
            'description'   => $request->description,
            'public'        => $request->public ?? false,
            'single_option' => $request->single_option ?? false,
        ]);

        Session::flash('status', 'You successfully created poll ' . $poll->name . '.');
        return redirect(action('Management\PollController@index'));
    }

    public function show(Poll $poll)
    {
        $totalVotes = $poll->votes()->count();
        return view('management.polls.show', compact('poll', 'totalVotes'));
    }

    public function edit(Poll $poll)
    {
        return view('management.polls.edit', compact('poll'));
    }

    public function update(Request $request, Poll $poll)
    {
        $poll->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'public'        => $request->public ?? false,
            'single_option' => $request->single_option ?? false
        ]);

        Session::flash('status', 'You successfully updated poll ' . $poll->name . '.');
        return redirect(action('Management\PollController@index'));
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();

        Session::flash('status', 'You successfully removed poll.');
        return redirect(action('Management\PollController@index'));
    }
}
