@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Isi Document</h2>

    <div class="row">
        <div class="col-md-6" style="margin-left: auto;">
            <form action="/dthistdoc" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Documents..." name="search" value="{{ request('search') }}">
                    <select class="form-select" name="iso">
                        <option value="">Select ISO</option>
                        @foreach ($isos as $iso)
                        <option value="{{ $iso->id }}" {{ request('iso') == $iso->id ? 'selected' : '' }}>
                            {{ $iso->description }}
                        </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <a href="{{ route('dthistdoc.create') }}" class="btn btn-primary">Tambah Data</a>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Description</th>
                <th>Created</th>
                <th>Department</th>
                <th>Document Number</th>
                <th>Actions</th> <!-- Kolom untuk tombol aksi -->
            </tr>
        </thead>
        <tbody>
            @php
            $startingNumber = $dtHistDocs->total() - ($dtHistDocs->currentPage() - 1) * $dtHistDocs->perPage();
            @endphp
            @foreach ($dtHistDocs as $dtHistDoc)
            <tr>
                <td>{{ $startingNumber-- }}</td>
                <td>{{ $dtHistDoc->description }}</td>
                <td>{{ $dtHistDoc->created_at->format('Y-m-d') }}</td>
                <td>{{ $dtHistDoc->document->dep_terkait }}</td>
                <td>{{ $dtHistDoc->doc_name }}</td>
                <td>
                    <a href="{{ route('dthistdoc.edit', $dtHistDoc->id) }}" class="btn btn-warning">Revisi</a>
                    <form action="{{ route('dthistdoc.destroy', $dtHistDoc->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('dthistdoc.detail', $dtHistDoc->doc_id) }}" class="btn btn-success">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $dtHistDocs->appends(request()->query())->links() }}

<script>
    function confirmDelete() {
        return confirm('Apakah Anda yakin menghapus dokumen ini? Ini akan menghapus semua folder yang berkaitan dengan dokumen ini.');
    }
</script>
@endsection
