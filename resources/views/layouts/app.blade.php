<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Document Digital')</title>
    <!-- Tambahkan link Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Tambahkan CSS kustom atau gayakan sesuai kebutuhan -->
    <style>
        /* Your custom styles go here */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Document Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @can('admin')
                        <!-- Dropdown Menu for Dashboard -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dashboard
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDashboardDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Main Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('not.approved.url') }}">Document Approval Process</a></li>
                                <li><a class="dropdown-item" href="{{ route('approved.url') }}">Document Release Process</a></li>
                            </ul>
                        </li>
                        @endcan
                        @can('hod')
                        <!-- Dropdown Menu for Dashboard -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dashboard
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDashboardDropdown">
                                <li><a class="dropdown-item" href="{{ route('not.approved.url') }}">Document Approval Process</a></li>
                            </ul>
                        </li>
                        @endcan
                        <!-- Dropdown Menu for Document Data -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDocumentDataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Document Data
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDocumentDataDropdown">
                                @can('admin')
                                <li><a class="dropdown-item" href="{{ route('documents.index') }}">Document Master List</a></li>
                                <li><a class="dropdown-item" href="{{ route('dthistdoc.index') }}">Document Detail</a></li>
                                <li><a class="dropdown-item" href="{{ route('types.index') }}">Type of Document</a></li>
                                @endcan
                                <li><a class="dropdown-item" href="{{ route('file.list')}}">Document List</a></li>
                            </ul>
                        </li>

                        @can('admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Departement
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDashboardDropdown">
                                <li><a class="dropdown-item" href="{{ route('dep.index') }}">List Departement</a></li>
                                <li><a class="dropdown-item" href="{{ route('dep.create') }}">Create Departement</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Plant
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDashboardDropdown">
                                <li><a class="dropdown-item" href="{{ route('company.index') }}">List Plant</a></li>
                                <li><a class="dropdown-item" href="{{ route('company.create') }}">Create Plant</a></li>
                            </ul>
                        </li>
                    @endcan

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Certification
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDashboardDropdown">
                            @can('admin')
                            <li><a class="dropdown-item" href="{{ route('isos.index') }}">List Certification</a></li>
                            <li><a class="dropdown-item" href="{{ route('isos.create') }}">Create Certification</a></li>
                            @endcan
                            @cannot('admin')
                            <li><a class="dropdown-item" href="{{ route('iso.view') }}">All Certification</a></li>
                            @endcannot
                        </ul>
                    </li>

                    @can('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('viewapproved') }}">User</a>
                    </li>
                    @endcan

                    @can('hod')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('approval.index') }}">Not Approved Documents</a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('new.document') }}">New Document</a>
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
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Tambahkan script JavaScript kustom atau sesuai kebutuhan -->
    <script>
        // Your custom scripts go here
    </script>
</body>

</html>
