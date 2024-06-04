@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Document Detail</h2>

        <div class="row">
            <div class="col-md-9" style="margin-left: auto;">
                <form action="/dthistdoc">
                    <div class="input-group mb-3">
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
                        <!-- Dropdown untuk Departemen -->
                        <select class="form-select" name="dep">
                            <option value="">Select Departemen</option>
                            @foreach ($deps as $dep)
                                <option value="{{ $dep->short }}" {{ request('dep') == $dep->short ? 'selected' : '' }}>
                                    {{ $dep->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Dropdown untuk Perusahaan -->
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

        <a href="{{ route('dthistdoc.create') }}" class="btn btn-primary">Tambah Data</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Document Name</th>
                    <th>Document No</th>
                    <th>ISO</th>
                    <th>Departement</th>
                    <th>Action</th> <!-- Tambah kolom untuk Action -->
                </tr>
            </thead>
            <tbody>
                @foreach ($dtHistDocs as $key => $dtHistDoc)
                    <tr>
                        <td>{{ $dtHistDoc->doc_id }}</td>
                        <td>{{ $dtHistDoc->description }}</td>
                         <td>{{ $dtHistDoc->doc_name }}</td>
                         <td>{{ $dtHistDoc->document->iso->description}}</td>
                        <td>{{ $dtHistDoc->document->dep_terkait }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('dthistdoc.edit', $dtHistDoc->id) }}" class="btn btn-warning">Revisi</a>

                            <!-- Tombol Delete -->
                            <form action="{{ route('dthistdoc.destroy', $dtHistDoc->id) }}" method="POST"
                                style="display: inline;" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Ensure this data has no relationships with other tables. Deleting related data will cause errors. Are you sure you want to delete?')"
                                >Delete</button>
                            </form>
                            <a href="{{ route('dthistdoc.detail', $dtHistDoc->doc_id) }}" class="btn btn-success">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $dtHistDocs->appends(request()->input())->links() }}

    <script>
        function confirmDelete() {
            return confirm(
                'Apakah Anda yakin menghapus dokumen ini? Ini akan menghapus semua folder yang berkaitan dengan dokumen ini.'
            );
        }
    </script>
@endsection
