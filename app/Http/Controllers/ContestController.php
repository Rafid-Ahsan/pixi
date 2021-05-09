<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\User;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contests = Contest::where('status', 'Approved')->paginate(10);

        return view('contest.index', [
            'contests' => $contests
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'first_prize' => 'required|integer',
            'second_prize' => 'required|integer',
        ]);

        Contest::create([
            'user_id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'first_prize' => $request->first_prize,
            'second_prize' => $request->second_prize
        ]);

        return redirect()->route('contest.personal', Contest::where('user_id', $request->id)->first()->id)->with('success', 'Your contest id added');
    }

    public function personal(Contest $contest) {
        $user = User::where('id', $contest->user_id)->first();

        return view('contest.single', [
            'contest' => $contest,
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
