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

        <!-- Detail DtHistCover -->
        <div class="card mb-3">
            <div class="card-header">
                Detail Cover
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Description</th>
                            <th>Tanggal Berlaku</th>
                            <th>Create</th>
                            <th>Revisi</th>
                            <th>Id Sebelum</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtHistCover as $key => $cover)
                            <tr>
                                <td>{{ $cover->id }}</td>
                                <td>{{ $cover->description }}</td>
                                <td>{{ $cover->tgl_berlaku }}</td>
                                <td>{{ $cover->createdBy->username }}</td>
                                <td>{{ $cover->revisi }}</td>
                                <td>{{ $cover->id_sebelum }}</td>
                                <td>

                                    <a href="{{ route('view.pdf', ['id' => $cover->id]) }}" class="btn btn-primary"
                                        target="_blank">View File</a>
                                    <form
                                        action="{{ route('dthistdoc.detaildelete', ['id' => $cover->id, 'type' => 'dtHistCover']) }}"
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

        <!-- Detail DtHistLampiran -->
        <div class="card mb-3">
            <div class="card-header">
                Detail Attachment
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
                        @foreach ($dtHistLampiran as $key => $lampiran)
                            <tr>
                                <td>{{ $lampiran->id }}</td>
                                <td>{{ $lampiran->description }}</td>
                                <td>{{ $lampiran->tgl_berlaku }}</td>
                                <td>{{ $lampiran->createdBy->username }}</td>
                                <td>{{ $lampiran->revisi }}</td>
                                <td>{{ $lampiran->id_sebelum }}</td>
                                <td>

                                    <a href="{{ route('view.pdflampiran', ['id' => $lampiran->id]) }}"
                                        class="btn btn-primary" target="_blank">View File</a>
                                    <form
                                        action="{{ route('dthistdoc.detaildelete', ['id' => $lampiran->id, 'type' => 'dtHistLampiran']) }}"
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

        <!-- Detail DtHistCatMut -->
        <div class="card mb-3">
            <div class="card-header">
                Detail Record
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Description</th>
                            <th>Tanggal Berlaku</th>
                            <th>Create</th>
                            <th>Revisi</th>
                            <th>Id Sebelum</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtHistCatMut as $key => $catmut)
                            <tr>
                                <td>{{ $catmut->id }}</td>
                                <td>{{ $catmut->description }}</td>
                                <td>{{ $catmut->tgl_berlaku }}</td>
                                <td>{{ $catmut->createdBy->username }}</td>
                                <td>{{ $catmut->revisi }}</td>
                                <td>{{ $catmut->id_sebelum }}</td>
                                <td>

                                    <a href="{{ route('view.pdfcatmut', ['id' => $catmut->id]) }}" class="btn btn-primary"
                                        target="_blank">View File</a>
                                    <form
                                        action="{{ route('dthistdoc.detaildelete', ['id' => $catmut->id, 'type' => 'dtHistCatMut']) }}"
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
