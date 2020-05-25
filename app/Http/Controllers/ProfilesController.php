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
        $activities = $user->activity()->with('subject')->latest()->get()->groupBy(function($activity) {
            return $activity->created_at->format('Y-m-d');
        });

        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => $activities
        ]);
    }
}
