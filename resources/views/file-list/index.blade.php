@extends('layouts.app')

@section('content')


    <div class="container mt-5">
        <h2 class="mb-4">ISO Name</h2>

        @if ($folders)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ISO Name</th>
                        <th scope="col">View Files</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($folders as $index => $folder)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ basename($folder) }}</td>
                            <td><a href="{{ route('file.view', ['folder' => basename($folder)]) }}"
                                    class="btn btn-primary">View Files</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No folders found.</p>
        @endif
    </div>

@endsection
