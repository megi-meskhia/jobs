@extends('layouts.app')

@section('title')
Apply for Job
@endsection

@section('content')
        <h5>Apply for Job</h5>

        <div class='card p-4 w-50 mt-3 mb-5' style='background:#f3f3f3'>
            <form method='POST' action="{{ route('jobs.storeApplication') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="job_id" value="{{ $job->id }}">

                <div class="form-group mb-3">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" name="name" value="{{$user['name']}}">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$user['email']}}">
                </div>
                <div class="form-group mb-3">
                    <label for="letter">Cover letter</label>
                    <textarea class="form-control" name="letter"></textarea>
                </div>
                <div class="form-group">
                    <label for="resume">Resume</label>
                    <input type="file" name="resume" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit Application</button>
            </form>
        </div>
        
@endsection
