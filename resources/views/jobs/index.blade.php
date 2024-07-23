@extends('jobs.layout')
@section('content')

@section('title')
   All Jobs
@endsection

<table class="table" style="background-color: #f3f3f3;">
    <thead class="thead-light">
        <tr>
            <th scope="col">Company</th>
            <th></th>
            <th scope="col">Jobs</th>
            <th scope="col">Published</th>
            <th scope="col">Available</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $job)
        <tr>
            <td style='width:50px'>
                <img src="{{ asset('storage/' . $job['logo']) }}" class="card-img-top px-2" style="width:100px;height:50px;object-fit:contain;">
            </td>
            <td>{{$job['company_name']}}</td>
            <td>{{$job['title']}}</td>
            <td>{{ \Carbon\Carbon::parse($job['created_at'])->format('Y-m-d') }}</td>
            <td>{{ \Carbon\Carbon::parse($job['avalable_at'])->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('jobs.show', [$job['id']]) }}" class="btn text-primary p-0 mr-3">
                    <span>Details</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right-circle mb-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.854 10.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z" />
                    </svg>
                </a>
            <td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
