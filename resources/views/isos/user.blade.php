@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Certification</h1>
        <h1></h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($isos as $iso)
                    <tr>
                        <td>{{ $iso->id }}</td>
                        <td>{{ $iso->description }}</td>
                        <td>{{ $iso->dt_created_date }}</td>
                        <td>
                            <a href="{{ route('isos.view', $iso->id) }}" class="btn btn-info">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
