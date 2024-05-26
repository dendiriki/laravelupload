<!-- resources/views/dthistdoc/detail.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Data PDF "{{ $document->description }}"</h2>

        <!-- Detail DtHistDoc -->
        <div class="card mb-3">
            <div class="card-header">
                Detail Document
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Description</th>
                            <th>Tanggal Berlaku</th>
                            <th>Create</th>
                            <th>revisi</th>
                            <th>Id Sebelum</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtHistDoc as $key => $doc)
                            <tr>
                                <td>{{ $doc->id }}</td>
                                <td>{{ $doc->description }}</td>
                                <td>{{ $doc->tgl_berlaku }}</td>
                                <td>{{ $doc->createdBy->username }}</td>
                                <td>{{ $doc->revisi }}</td>
                                <td>{{ $doc->id_sebelum }}</td>
                                <td>

                                    <a href="{{ route('view.pdfdoc', ['id' => $doc->id]) }}" class="btn btn-primary"
                                        target="_blank">View File</a>
                                    <form
                                        action="{{ route('dthistdoc.detaildelete', ['id' => $doc->id, 'type' => 'dtHistDoc']) }}"
                                        method="POST" style="display: inline;">
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
        </div>


    </div>
@endsection
