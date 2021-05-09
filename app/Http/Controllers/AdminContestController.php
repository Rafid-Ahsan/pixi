<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminContestController extends Controller
{
    public function index() {
        $contests = User::join('contests', 'users.id', '=', 'contests.user_id')->select('users.*' ,'users.name as publisher_name', 'contests.*')->paginate(10);

        return view('admin.contest.index', [
            'contests' => $contests
        ]);
    }

    public function update_status(Contest $contest, Request $request) {
        $contest->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.contest.index')->with('success', 'You have successfully edited the Contest');
    }

    public function delete(Contest $contest) {
        $contest->delete();

        return redirect()->route('admin.contest.index')->with('success', 'You have successfully deleted the Contest');
    }
}
