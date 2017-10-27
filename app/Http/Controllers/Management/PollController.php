<?php

namespace App\Http\Controllers\Management;

use App\Poll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class PollController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Auth::user()->polls;

        return view('management.polls.index', compact(['polls']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.polls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pollObj = Poll::create([
            'user_id' => Auth::user()->id,
            'name' => $request->input('name'),
            'code' => uniqid(),
            'description' => $request->input('description'),
            'public' => $request->input('public', false),
            'single_option' => $request->input('single_option', false),
        ]);

        Session::flash('status', 'You successfully created poll ' . $pollObj->name . '.');

        return redirect(action('Management\PollController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($poll)
    {
        $pollObj = Poll::where('code', $poll)->firstOrFail();

        $totalVotes = $pollObj->votes()->count();

        return view('management.polls.show', compact(['pollObj', 'totalVotes']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($poll)
    {
        $pollObj = Poll::where('code', $poll)->firstOrFail();


        return view('management.polls.edit', compact(['pollObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $poll)
    {
        $pollObj = Poll::where('code', $poll)->firstOrFail();

        $pollObj->name = $request->input('name');
        $pollObj->description = $request->input('description');
        $pollObj->public = $request->input('public', false);
        $pollObj->single_option = $request->input('single_option', false);
        $pollObj->save();

        Session::flash('status', 'You successfully updated poll ' . $pollObj->name . '.');

        return redirect(action('Management\PollController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($poll)
    {
        $pollObj = Poll::where('code', $poll)->firstOrFail();
        $pollObj->delete();

        Session::flash('status', 'You successfully removed poll ' . $pollObj->name . '.');

        return redirect(action('Management\PollController@index'));
    }
}
