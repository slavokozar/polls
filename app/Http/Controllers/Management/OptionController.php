<?php

namespace App\Http\Controllers\Management;

use App\Option;
use App\Poll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OptionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($poll)
    {
        $pollObj = Auth::user()->polls()->where('code', $poll)->firstOrFail();
        $options = $pollObj->options;

        return view('management.options.index', compact(['pollObj', 'options']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($poll)
    {
        $pollObj = Auth::user()->polls()->where('code', $poll)->firstOrFail();

        return view('management.options.create', compact(['pollObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $poll)
    {
        $pollObj = Auth::user()->polls()->where('code', $poll)->firstOrFail();

        $optionObj = Option::create([
            'poll_id' => $pollObj->id,
            'name' => $request->input('name')
        ]);


        Session::flash('status', 'You successfully created option `' . $optionObj->name . '` from poll `' . $pollObj->name . '`.');

        return redirect(action('Management\OptionController@index', $pollObj->code));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($poll, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($poll, $id)
    {
        $pollObj = Auth::user()->polls()->where('code', $poll)->firstOrFail();
        $optionObj = $pollObj->options()->findOrFail($id);

        return view('management.options.edit', compact(['pollObj', 'optionObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $poll, $id)
    {
        $pollObj = Auth::user()->polls()->where('code', $poll)->firstOrFail();
        $optionObj = $pollObj->options()->findOrFail($id);

        $optionObj->name = $request->input('name');
        $optionObj->save();

        Session::flash('status', 'You successfully updated option `' . $optionObj->name . '` from poll `' . $pollObj->name . '`.');

        return redirect(action('Management\OptionController@index', $pollObj->code));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($poll, $id)
    {
        $pollObj = Auth::user()->polls()->where('code', $poll)->firstOrFail();
        $optionObj = $pollObj->options()->findOrFail($id);
        $optionObj->delete();


        Session::flash('status', 'You successfully removed option `' . $optionObj->name . '` from poll `' . $pollObj->name . '`.');

        return redirect(action('Management\OptionController@index', $poll));
    }
}
