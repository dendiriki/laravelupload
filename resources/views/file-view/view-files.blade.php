@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">View Files in '{{ $folder }}'</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $index => $file)
                    @php $fileName = basename($file); @endphp
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $fileName }}</td>
                        <td>File</td>
                        <td>
                            <a href="{{ Storage::url($file) }}" class="btn btn-primary" target="_blank">View File</a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($directories as $index => $dir)
                    @php $dirName = basename($dir); @endphp
                    <tr>
                        <th scope="row">{{ count($files) + $index + 1 }}</th>
                        <td>{{ $dirName }}</td>
                        <td>Directory</td>
                        <td>
                            <a href="{{ route('file.view', ['folder' => $folder . '/' . $dirName]) }}"
                                class="btn btn-primary">View Files</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('file.list') }}" class="btn btn-primary">Back to File List</a>
    </div>
@endsection
