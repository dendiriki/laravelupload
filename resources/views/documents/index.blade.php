@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Documents</h2>

        <div class="row">
            <div class="col-md-9" style="margin-left: auto;">
                <form action="/documents">
                    <div class="input-group mb-6">
                        <input type="text" class="form-control" placeholder="Search Documents..." name="search"
                               value="{{ request('search') }}">
                        <select class="form-select" name="iso">
                            <option value="">Select ISO</option>
                            @foreach ($isos as $iso)
                                <option value="{{ $iso->id }}" {{ request('iso') == $iso->id ? 'selected' : '' }}>
                                    {{ $iso->description }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Tambahkan ini untuk Departemen -->
                        <select class="form-select" name="dep">
                        <option value="">Select Departemen</option>
                        @foreach ($deps as $dep)
                            <option value="{{ $dep->short }}" {{ request('dep') == $dep->short ? 'selected' : '' }}>
                                {{ $dep->name }} ({{ $dep->short }})
                            </option>
                        @endforeach
                    </select>


                        <!-- Tambahkan ini untuk Perusahaan -->
                        <select class="form-select" name="company">
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ request('company') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
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
                    <th>ID</th>
                    <th>Document Name</th>
                    <th>Document No</th>
                    <th>Type</th>
                    <th>ISO</th>
                    <th>Departement</th>
                    <th>Company</th>
                    <th>Action</th> <!-- Tambah kolom untuk Action -->
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                    <td>{{ $document->sequence }}</td>
                        <td>{{ $document->description }}</td>
                        <td>{{ $document->doc_name }}</td>
                        <td>{{ $document->type->short }}</td>
                        <td>{{ $document->iso->description }}</td>
                        <td>{{ $document->dep_terkait }}</td>
                        <td>{{ $document->company->name}}</td>
                        <!-- <td>{{ $document->createdBy ? $document->createdBy->username : 'N/A' }}</td> -->
                        <td>
                            <a href="{{ route('documents.edit', ['id' => $document->id]) }}"
                                class="btn btn-primary">Edit</a>

                            <!-- Tombol Delete -->
                            <form action="{{ route('documents.destroy', ['id' => $document->id]) }}" method="POST"
                                style="display: inline;" onsubmit="return confirmDelete()">
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
    {{ $documents->links() }}

    @if(session('customError'))
    <script>
        alert('{{ session("customError") }}');
    </script>
    @endif

    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin menghapus dokumen ini?. sebelum menghapus dokumen ini pastikan tidak ada isi dokumen yang berkaitan data yang anda hapus ini');
        }
    </script>
@endsection