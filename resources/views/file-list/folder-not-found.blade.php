<!-- folder-not-found.blade.php (resources/views) -->
@extends('layouts.app')

@section('content')
    <h1>Folder Not Found</h1>
    <p>The folder "{{ $folder }}" does not exist.</p>
    <a href="{{ route('home') }}">Back to Home</a>
@endsection
