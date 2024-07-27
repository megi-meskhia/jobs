@extends('layouts.app')

@section('title')
Profile
@endsection

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <h4>Company: <span style="font-weight:bold;">{{ $user['name'] }}</span></h4>

    <a href="/jobs/create" class="text-primary align-items-center" style="text-decoration:none;{{ Auth::check() ? 'display:flex' : 'display:flex;' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill mx-2" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
        </svg>
        <h5 class='mb-0'>Create New Job</h5>
    </a>
</div>

<div class="row">
    @foreach ($jobs as $job)
    <div class="col-md-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header d-flex">
                <img src="{{ asset('storage/' . $job['logo']) }}" class="card-img-top" style="width:auto;height:50px;object-fit:contain;margin-right:10px;">
                <h6 class="card-title" style="font-weight:bold;">{{ $job->user->name }}</h6>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$job['title']}}</h5>
                <p class="card-text" style="display: -webkit-box;-webkit-line-clamp: 5;-webkit-box-orient: vertical;overflow: hidden;">{{$job['description']}}</p>
                <h6 class="card-title">{{$job['salary']/100}}₾</h6>
                <p class='text-muted'>Published: {{ \Carbon\Carbon::parse($job['created_at'])->format('Y-m-d') }}</p>
                <p class='text-muted'>Available Till: {{ \Carbon\Carbon::parse($job['available_till'])->format('Y-m-d') }}</p>
                <div class='d-inline-block'>
                    <a href="{{ route('jobs.edit', [$job['id']]) }}" class="btn text-primary p-0 mr-3">Edit</a>
                </div>
                <div class='d-inline-block'>
                    <form method='POST' action='{{ route('jobs.delete', [$job['id']]) }}'>
                        @csrf
                        @method('DELETE')
                        <button type='submit' class='btn text-danger p-0 mx-3' onclick="return confirm('are you sure')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection