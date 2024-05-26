@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">ISO Name</h2>

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
