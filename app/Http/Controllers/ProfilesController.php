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
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => $this->getActivity($user)
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    protected function getActivity(User $user)
    {
        return $user->activity()->with('subject')->latest()->take(50)->get()->groupBy(function ($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}
