<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($id)
{
    $user = User::findOrFail($id);
    $jobs = $user->jobs;

    $job_applications = JobApplication::whereIn('job_id', $jobs->pluck('id'))->get();

    return view('jobs.user_profile', ['user' => $user, 'jobs' => $jobs, 'job_applications' => $job_applications]);
}

}