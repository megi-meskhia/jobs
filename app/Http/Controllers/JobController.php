<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

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
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'company_name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'salary' => 'required|numeric|max:1000000',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'available_at' => 'required|date'
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            $validated['logo'] = null;
        }

        Job::create([
            'title' => $validated['title'],
            'company_name' => $validated['company_name'],
            'description' => $validated['description'],
            'salary' => $validated['salary'] * 100,
            'logo' => $validated['logo'],
            'available_at' => $validated['available_at']
        ]);

        return redirect('/jobs')->with('add_successful', 'Job was Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'company_name' => 'required|string|max:100',
            'description' => 'nullable|string|max:10000',
            'salary' => 'required|numeric|max:1000000',
            // 'logo' => 'required|logo|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'available_at' => 'required|date'
        ]);

        $job->update([
            'title' => $validated['title'],
            'company_name' => $validated['company_name'],
            'description' => $validated['description'],
            'salary' => $validated['salary'] * 100,
            // 'logo' => $validated['logo'],
            'available_at' => $validated['available_at']
        ]);

        return redirect('/jobs')->with('edit_successful', 'Job was Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        // TODO delete job photos

        return redirect('/jobs')->with('edit_delete', 'Job was Deleted');
    }

    public function apply($job)
    {
        return view('jobs.apply', ['job' => $job]);
    }

    public function storeApplication(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'letter' => 'required|string|max:1000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // $resumePath = $request->file('resume')->store('resumes', 'public');

        JobApplication::create([
            'job_id' => $validated['job_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'letter' => $validated['letter'],
            'resume' => $validated['resume'],
        ]);

        return redirect('/jobs')->with('apply_successful', 'Application submitted successfully.');
    }
}
