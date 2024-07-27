@extends('layouts.app')
@section('content')

@section('title')
Edit Job
@endsection
<h5>Edit Job</h5>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class='card p-4 w-50 mt-3 mb-5' style='background:#f3f3f3'>
    <form method='POST' action="{{ route('jobs.update', [$job['id']]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" name="company_name" value='{{ $job->user->name }}' disabled>
        </div>
        <div class="form-group mb-3">
            <label for="title">Job Title</label>
            <input type="text" class="form-control" name="title" value='{{ $job['title'] }}'>
        </div>
        <div class="form-group mb-3">
            <label for="description">Job Description</label>
            <textarea class="form-control" name="description"> {{ $job['description'] }} </textarea>
        </div>
        <div class="form-group mb-3">
            <label for="salary">Job Salary</label>
            <input type="text" class="form-control" name="salary" value='{{ $job['salary'] / 100 }}'>
        </div>
        <div class="form-group mb-3">
            <label for="available_till">Available At</label>
            <input type="date" name="available_till" class="form-control" value="{{ old('available_till') }}">
        </div>
        <div class="form-group mb-4">
            <label for="logo">Company Logo</label>
            <input type="file" class="form-control" name="logo">
        </div>
        <button type="submit" class="btn btn-primary w-25">Submit</button>
    </form>
</div>
@endsection
