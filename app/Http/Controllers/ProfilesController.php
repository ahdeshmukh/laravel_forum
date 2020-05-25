<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user)
    {
        $activities = $user->activity()->latest()->with('subject')->get();
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => $activities
        ]);
    }
}
