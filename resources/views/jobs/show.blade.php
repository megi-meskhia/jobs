@extends('layouts.app')

@section('title')
    About Job
@endsection

@section('content')

<h4 class='my-4'>About Job</h4>
<div class="card mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class='card-header d-flex align-items-center'>
                <img src="{{ asset('storage/' . $job['logo']) }}" class="card-img-top px-2" style="width:100px;height:50px;object-fit:contain;">
                <h5>{{$job->user->name}}</h5>
            </div>
        </div>
        <div class="col-md-12">
            <div class='card-body'>
                <h5>{{$job['title']}}</h5>
                <p>{{$job['description']}}</p>
                <h5 class='text-danger mb-3'>Salary: {{$job['salary']/100}}₾</h5>
                <p class='text-muted'>Published: {{ \Carbon\Carbon::parse($job['created_at'])->format('Y-m-d') }}</p>
                <p class='text-muted'>Available Till: {{ \Carbon\Carbon::parse($job['available_till'])->format('Y-m-d') }}</p>
                @if (Auth::check() && Auth::user()->account_type === 'person')
                <a href="{{ route('jobs.apply', [$job['id']]) }}" class="btn btn-primary mb-3 px-4">
                    Apply for Job
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
