@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data DtHistDoc</h2>
        <a href="{{ route('dthistdoc.create') }}" class="btn btn-primary">Tambah Data</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Id.</th>
                    <th>Description</th>
                    <th>Tanggal Berlaku</th>
                    <th>Create</th>
                    <th>Nomer document</th>
                    <th>Actions</th> <!-- Kolom untuk tombol aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach ($dtHistDocs as $key => $dtHistDoc)
                    <tr>
                        <td>{{ $dtHistDoc->id }}</td>
                        <td>{{ $dtHistDoc->description }}</td>
                        <td>{{ $dtHistDoc->created_at }}</td>
                        <td>{{ $dtHistDoc->createdBy->username }}</td>
                        <td>{{$dtHistDoc->doc_name}}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('dthistdoc.edit', $dtHistDoc->id) }}" class="btn btn-warning">Revisi</a>

                            <!-- Tombol Delete -->
                            <form action="{{ route('dthistdoc.destroy', $dtHistDoc->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{route('dthistdoc.detail', $dtHistDoc->doc_id)}}" class="btn btn-success">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

{{--
<a href="{{ route('dthistdoc.edit', $dtHistDoc->id) }}" class="btn btn-warning">Edit</a>

<!-- Tombol Delete -->
<form action="{{ route('dthistdoc.destroy', $dtHistDoc->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form> --}}
