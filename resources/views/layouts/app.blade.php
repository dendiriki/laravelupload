<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your App Title')</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS kustom atau gayakan sesuai kebutuhan -->
    <style>
        /* Your custom styles go here */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Upload PDF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @can('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('isos.index') }}">ISOs</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('types.index') }}">Types</a>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('documents.index') }}">Documents</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dthistdoc.index') }}">Historical Documents</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('docdept.index') }}">Doc Dept</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dep.index') }}">Dept</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endcan

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('file.list') }}">File List</a>
                    </li>
                    <!-- Tambahkan item navbar sesuai kebutuhan -->
                </ul>
                <ul class="navbar-nav ms-auto">

                    @if (Auth::check())
                        <!-- Tampilkan user info dan logout button -->

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <li class="nav-item">
                            <p class="nav-link"> username : {{ Auth::user()->username }}</p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    @else
                        <!-- Tampilkan login/register links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <!-- Tambahkan script Bootstrap JS (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tambahkan script JavaScript kustom atau sesuai kebutuhan -->
    <script>
        // Your custom scripts go here
    </script>
</body>

</html>
