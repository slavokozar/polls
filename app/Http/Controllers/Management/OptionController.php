<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Option;
use App\Poll;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            return optional($request->route('poll'))->user_id == Auth::user()->id ?
                $next($request) :
                abort(403);
        });
    }

    public function index(Poll $poll)
    {
        $options = $poll->options;
        return view('management.options.index', compact('poll', 'options'));
    }

    public function create(Poll $poll)
    {
        return view('management.options.create', compact('poll'));
    }

    public function store(CreateOptionRequest $request, Poll $poll)
    {
        $option = Option::create([
            'poll_id' => $poll->id,
            'name'    => $request->name
        ]);

        Session::flash('status', 'You successfully created option `' . $option->name . '` from poll `' . $poll->name . '`.');
        return redirect(action('Management\OptionController@index', $poll->code));
    }

    public function show(Poll $poll, $id)
    {
        //
    }

    public function edit(Poll $poll, $id)
    {
        $option = $poll->options()->findOrFail($id);
        return view('management.options.edit', compact('poll', 'option'));
    }

    public function update(UpdateOptionRequest $request, Poll $poll, $id)
    {
        $option = $poll->options()->findOrFail($id);
        $option->update(['name' => $request->name]);

        Session::flash('status', 'You successfully updated option `' . $option->name . '` from poll `' . $poll->name . '`.');
        return redirect(action('Management\OptionController@index', $poll->code));
    }

    public function destroy(Poll $poll, $id)
    {
        $option = $poll->options()->findOrFail($id);
        $option->delete();

        Session::flash('status', 'You successfully removed option from poll `' . $poll->name . '`.');
        return redirect(action('Management\OptionController@index', $poll));
    }
}
