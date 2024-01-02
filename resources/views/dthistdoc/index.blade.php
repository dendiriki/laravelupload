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
                    <th>Tanggal Perubahan</th>
                    <th>Tanggal Berlaku</th>
                    <th>Doc ID</th>
                    <th>Revisi</th>
                    <th>ID Sebelum</th>
                    <th>Link Document</th>
                    <th>VC Created User</th>
                    <th>Company ID</th>
                    <th>NoDoc</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dtHistDocs as $key => $dtHistDoc)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $dtHistDoc->description }}</td>
                        <td>{{ $dtHistDoc->tgl_perubahan }}</td>
                        <td>{{ $dtHistDoc->tgl_berlaku }}</td>
                        <td>{{ $dtHistDoc->doc_id }}</td>
                        <td>{{ $dtHistDoc->revisi }}</td>
                        <td>{{ $dtHistDoc->id_sebelum }}</td>
                        <td>{{ $dtHistDoc->link_document }}</td>
                        <td>{{ $dtHistDoc->vc_created_user }}</td>
                        <td>{{ $dtHistDoc->comp_id }}</td>
                        <td>{{ $dtHistDoc->nodoc }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
