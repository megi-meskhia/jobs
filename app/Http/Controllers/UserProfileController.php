<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($id)
{
    $user = User::findOrFail($id);
    $jobs = $user->jobs;
    return view('jobs.user_profile', ['user' => $user, 'jobs' => $jobs]);
}

}