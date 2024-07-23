<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>
<body>
    
    <header class="mb-5 py-4 shadow" style="background-color: #f3f3f3;">
        <div class="container">
            <div class='text-center d-flex align-items-center justify-content-between'>
                <a href="/jobs" class="text-primary" style='text-decoration:none;'>
                    <h4 class='text-primary'>All Jobs</h4>
                </a>
                <div class="d-flex align-items-center">
                    <a href="jobs/profile" class="text-primary align-items-center" style="text-decoration:none;{{ Auth::check() ? 'display:flex' : 'display:flex;' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle mx-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <h5 class="mb-0">Profile</h5>
                    </a>
                    <!-- <a href="jobs/create" class="text-primary align-items-center mx-3" style="text-decoration:none;{{ Auth::check() ? 'display:flex' : 'display:flex;' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill mx-2" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                          </svg>
                        <h5 class='mb-0'>Create New Job</h5>
                    </a> -->
                    <a href="/login" class="btn btn-primary mx-3" style="text-decoration: none;">Log In</a>
                    <a href="/register" class="btn btn-primary" style="text-decoration: none;">Registration</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container">

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

       @yield('content')

    </div>
</body>
</html>