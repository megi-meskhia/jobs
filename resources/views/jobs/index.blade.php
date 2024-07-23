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
        <div class='my-4 text-center d-flex align-items-center justify-content-between'>
            <a href="/jobs" class="text-primary" style='text-decoration:none;'>
                <h4 class='text-primary'>All Jobs</h4>
            </a>
            <a href="jobs/profile" class="text-primary align-items-center justify-content-end" style='text-decoration:none;{{ Auth::check() ? 'display:flex' : 'display:flex;' }}'>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle mx-2" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                <h4 class='mb-1'>Profile</h4>
            </a>
        </div>

        @if (session('add_successful'))
        <div class="alert alert-success">
            {{ session('add_successful') }}
        </div>
        @endif
        @if (session('edit_successful'))
        <div class="alert alert-success">
            {{ session('edit_successful') }}
        </div>
        @endif
        @if (session('edit_delete'))
        <div class="alert alert-danger">
            {{ session('edit_delete') }}
        </div>
        @endif
        @if (session('apply_successful'))
        <div class="alert alert-success">
            {{ session('apply_successful') }}
        </div>
        @endif

        <table class="table">
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
    </div>
</body>
</html>
