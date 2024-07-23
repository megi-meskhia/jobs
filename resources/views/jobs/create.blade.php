<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class='container'>
        <div class='text-center my-4'>
            <a href="/jobs" class="text-primary d-flex align-items-center" style='text-decoration:none;'>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                </svg>
                <h4 class='mb-1 mx-2'>All Jobs</h4>
            </a>
        </div>
        <h5>Add Jobs</h5>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class='card p-4 w-50 mt-3' style='background:#f3f3f3'>
            <form method='POST' action="{{ route('jobs.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Job Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Job Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="salary">Job Salary</label>
                    <input type="text" class="form-control" name="salary">
                </div>
                <div class="form-group mb-3">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" name="company_name">
                </div>
                <div class="form-group mb-3">
                    <label for="available_at">Available At</label>
                    <input type="date" name="available_at" class="form-control" value="{{ old('available_at', $job->available_at ? $job->available_at->format('Y-m-d') : '') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="logo">Company Logo</label>
                    <input type="file" class="form-control" name="logo">
                </div>
                <button type="submit" class="btn btn-primary w-25">Create</button>
            </form>
        </div>
    </div>
</body>
</html>
