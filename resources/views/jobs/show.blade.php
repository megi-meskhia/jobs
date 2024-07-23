<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <a href="/jobs" class="text-primary d-flex align-items-center mt-4" style='text-decoration:none;'>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
            </svg>
            <h4 class='mb-1 mx-2'>All Jobs</h4>
        </a>
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
    </div>
</body>
</html>
