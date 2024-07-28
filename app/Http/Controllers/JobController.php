<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Rules\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::get();

        return view('jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('jobs.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:10000',
            'salary' => 'required|numeric|max:1000000',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'available_till' => 'required|date'
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            $validated['logo'] = null;
        }

        Job::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'salary' => $validated['salary'] * 100,
            'logo' => $validated['logo'],
            'available_till' => $validated['available_till'],
            'user_id' => Auth::id()
        ]);

        return redirect("/jobs/user_profile/" . auth()->id())->with('edit_successful', 'Job was Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load('user');
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $job->load('user');
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:10000',
            'salary' => 'required|numeric|max:1000000',
            'logo' => 'nullable', new Logo, 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'available_till' => 'required|date'
        ]);

        if ($request->hasFile('logo')) {
            // Delete the old logo file
            if ($job->logo) {
                Storage::disk('public')->delete($job->logo);
            }
            // Store the new logo file
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            // Keep the existing logo if no new logo is uploaded
            $validated['logo'] = $job->logo;
        }

        $job->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'salary' => $validated['salary'] * 100,
            'logo' => $validated['logo'],
            'available_till' => $validated['available_till']
        ]);

        return redirect("/jobs/user_profile/" . auth()->id())->with('edit_successful', 'Job was Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        // Check if the job has a logo
        if ($job->logo) {
            // Check if the file exists
            if (Storage::disk('public')->exists($job->logo)) {
                // Attempt to delete the file
                Storage::disk('public')->delete($job->logo);
            } else {
                // Debug: file does not exist
                dd('File does not exist: ' . $job->logo);
            }
        }

        $job->delete();

        // TODO delete job photos
        return redirect("/jobs/user_profile/" . auth()->id())->with('edit_delete', 'Job was Deleted');
    }

    public function apply(Job $job)
    {
        $user = Auth::user();
        return view('jobs.apply', ['job' => $job, 'user' => $user]);
    }

    public function storeApplication(Request $request, Job $job)
    {
        $validated = $request->validate([
            'letter' => 'required|string|max:1000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'job_id' => 'required|exists:jobs,id'
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        JobApplication::create([
            'letter' => $validated['letter'],
            'resume' => $validated['resume'],
            'user_id' => Auth::id(),
            'job_id' => $validated['job_id']
        ]);

        return redirect("/jobs/user_profile/" . auth()->id())->with('edit_successful', 'Application submitted successfully.');
    }
}
