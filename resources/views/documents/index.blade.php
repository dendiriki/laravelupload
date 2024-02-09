@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Documents</h2>

    <div class="row">
        <div class="col-md-6" style="margin-left: auto;">
            <form action="/documents" method="GET">
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

    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Create New Document</a>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Description</th>
                <th>Type</th>
                <th>ISO</th>
                <th>Date Created</th>
                <th>Document Number</th>
                <th>Created By</th>
                <th>Action</th> <!-- Tambah kolom untuk Action -->
            </tr>
        </thead>
        <tbody>
            @php
            $startingNumber = $documents->total() - ($documents->currentPage() - 1) * $documents->perPage();
            @endphp
            @foreach ($documents as $document)
            <tr>
                <td>{{ $startingNumber-- }}</td>
                <td>{{ $document->description }}</td>
                <td>{{ $document->type ? $document->type->short : 'N/A' }}</td>
                <td>{{ $document->iso ? $document->iso->description : 'N/A' }}</td>
                <td>{{ $document->dt_created_date }}</td>
                <td>{{ $document->doc_name }}</td>
                <td>{{ $document->createdBy ? $document->createdBy->username : 'N/A' }}</td>
                <td>
                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
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
{{ $documents->appends(request()->query())->links() }}

@if(session('customError'))
<script>
    alert('{{ session("customError") }}');
</script>
@endif

<script>
    function confirmDelete() {
        return confirm('Apakah Anda yakin menghapus dokumen ini? Sebelum menghapus dokumen ini pastikan tidak ada isi dokumen yang berkaitan dengan data yang Anda hapus.');
    }
</script>
@endsection
