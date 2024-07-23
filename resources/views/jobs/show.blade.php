@extends('jobs.layout')

@section('title')
    {{ $job['title'] }}
@endsection

@section('content')

<h4 class='my-4'>About Job</h4>
<div class="card mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class='card-header d-flex align-items-center'>
                <img src="{{ asset('storage/' . $job['logo']) }}" class="card-img-top px-2" style="width:100px;height:50px;object-fit:contain;">
                <h5>{{$job['company_name']}}</h5>
            </div>
        </div>
        <div class="col-md-12">
            <div class='card-body'>
                <h5>{{$job['title']}}</h5>
                <p>{{$job['description']}}</p>
                <h5 class='text-danger mb-3'>Salary: {{$job['salary']/100}}₾</h5>
                <p class='text-muted'>Published: {{ \Carbon\Carbon::parse($job['created_at'])->format('Y-m-d') }}</p>
                <p class='text-muted'>Available: {{ \Carbon\Carbon::parse($job['avalable_at'])->format('Y-m-d') }}</p>
                <a href="{{ route('jobs.apply', [$job['id']]) }}" class="btn btn-primary mb-3 px-4" style="{{ Auth::check() ? 'display:inline' : 'display:none;' }}">Apply for Job</a>
            </div>
        </div>
    </div>
</div>

@endsection
