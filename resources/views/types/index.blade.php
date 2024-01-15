@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Types</h1>

        <a href="{{ route('types.create') }}" class="btn btn-primary">Create New Type</a>

        <ul class="list-group mt-3">
            @foreach ($types as $type)
                <li class="list-group-item">
                    <h5 class="mb-1">Description: {{ $type->description }}</h5>
                    <p class="mb-1">Created By: {{ $type->createdBy->username }}</p>
                    <p class="mb-1">Modified By: {{ $type->modifiedBy->username }}</p>
                    <p class="mb-1">Company: {{ $type->company->short }}</p>
                    <p class="mb-1">Created At: {{ $type->dt_created_date }}</p>
                    <p class="mb-1">Updated At: {{ $type->dt_modified_date }}</p>

                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('types.edit', $type->id) }}" class="btn btn-warning mr-2">Edit</a>

                        <!-- Tombol Delete -->
                        <form action="{{ route('types.destroy', $type->id) }}" method="POST" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>

                    <hr>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin menghapus tipe ini, sebelum menghapus data ini pastikan tidak ada document yang berkaitan degan type ini karena akan membuat data menjadi error nantinya?');
        }
    </script>
@endsection
