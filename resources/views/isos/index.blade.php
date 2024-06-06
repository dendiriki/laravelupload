@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Certification</h1>

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
                            <a href="{{ route('isos.edit', $iso->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('isos.destroy', $iso->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Pastikan data ini tidak memiliki hubungan dengan tabel lain. Menghapus data yang terkait akan menyebabkan kesalahan. Anda yakin ingin menghapus?')">Hapus</button>
                            </form>
                            <a href="{{ route('isos.view', $iso->id) }}" class="btn btn-info">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
