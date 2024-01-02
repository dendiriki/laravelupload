@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data DtHistDoc</h2>
        <a href="{{ route('dthistdoc.create') }}" class="btn btn-primary">Tambah Data</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>Tanggal Berlaku</th>
                    <th>Doc ID</th>
                    <th>Revisi</th>
                    <th>ID Sebelum</th>
                    <th>User</th>
                    <th>Actions</th> <!-- Kolom untuk tombol aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach ($dtHistDocs as $key => $dtHistDoc)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $dtHistDoc->description }}</td>
                        <td>{{ $dtHistDoc->tgl_berlaku }}</td>
                        <td>{{ $dtHistDoc->document->description }}</td>
                        <td>{{ $dtHistDoc->revisi }}</td>
                        <td>{{ $dtHistDoc->id_sebelum }}</td>
                        <td>{{ $dtHistDoc->vc_created_user }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="" class="btn btn-warning">Edit</a>

                            <!-- Tombol Delete -->
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
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
