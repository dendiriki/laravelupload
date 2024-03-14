@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">ISO Name</h2>

        <!-- Tombol "Register New Document" -->
        <a href="{{ route('register.document') }}" class="btn btn-success float-right ml-2 mb-4">Register New Document</a>

        <!-- Tombol "Register Revision" -->
        <a href="{{ route('register.revision') }}" class="btn btn-primary float-right ml-2 mb-4">Register Revision</a>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($isos->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ISO Name</th>
                        <th scope="col">View Files</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($isos as $index => $iso)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $iso->description }}</td> {{-- Asumsikan kolom ini adalah nama ISO --}}
                            <td><a href="{{ route('view.files', ['isoId' => $iso->id]) }}"
                                    class="btn btn-primary">View Files</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No ISOs found.</p>
        @endif
    </div>
@endsection
