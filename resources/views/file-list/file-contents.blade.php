<!-- file-contents.blade.php (resources/views) -->
@extends('layouts.app')

@section('content')
    <h1>Contents of Folder: {{ $folder }}</h1>

    @if (count($files) > 0)
        <ul>
            @foreach ($files as $file)
                <li><a href="{{ asset($file) }}" target="_blank">{{ basename($file) }}</a></li>
            @endforeach
        </ul>
    @else
        <p>No files found in this folder.</p>
    @endif
@endsection
