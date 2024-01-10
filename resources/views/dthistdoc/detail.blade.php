<!-- resources/views/dthistdoc/detail.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Data PDF "{{$document->description}}"</h2>

        <!-- Detail DtHistDoc -->
        <div class="card mb-3">
            <div class="card-header">
                Detail DtHistDoc
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
                            <th>Nomer Document</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtHistDoc as $key => $doc)
                            <tr>
                                <td>{{ $doc->id }}</td>
                                <td>{{ $doc->description }}</td>
                                <td>{{ $doc->created_at }}</td>
                                <td>{{ $doc->createdBy->username }}</td>
                                <td>{{$doc->revisi}}</td>
                                <td>{{ $doc->doc_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail DtHistCover -->
        <div class="card mb-3">
            <div class="card-header">
                Detail DtHistCover
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
                            <th>Nomer Document</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtHistCover as $key => $cover)
                            <tr>
                                <td>{{ $cover->id }}</td>
                                <td>{{ $cover->description }}</td>
                                <td>{{ $cover->created_at }}</td>
                                <td>{{ $cover->createdBy->username }}</td>
                                <td>{{$cover->revisi}}</td>
                                <td>{{ $cover->doc_name }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail DtHistLampiran -->
        <div class="card mb-3">
            <div class="card-header">
                Detail DtHistLampiran
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
                            <th>Nomer Document</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtHistLampiran as $key => $lampiran)
                            <tr>
                                <td>{{ $lampiran->id }}</td>
                                <td>{{ $lampiran->description }}</td>
                                <td>{{ $lampiran->created_at }}</td>
                                <td>{{ $lampiran->createdBy->username }}</td>
                                <td>{{$lampiran->revisi}}</td>
                                <td>{{ $lampiran->doc_name }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail DtHistCatMut -->
        <div class="card mb-3">
            <div class="card-header">
                Detail DtHistCatMut
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
                            <th>Nomer Document</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtHistCatMut as $key => $catmut)
                            <tr>
                                <td>{{ $catmut->id }}</td>
                                <td>{{ $catmut->description }}</td>
                                <td>{{ $catmut->created_at }}</td>
                                <td>{{ $catmut->createdBy->username }}</td>
                                <td>{{$catmut->revisi}}</td>
                                <td>{{ $catmut->doc_name }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
