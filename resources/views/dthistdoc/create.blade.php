@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah DtHistDoc</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <!-- Form Filter -->
        <div class="row mb-3">
            <div class="col-md-9" style="margin-left: auto;">
                <form action="{{ route('dthistdoc.create') }}" method="get">
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
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <form action="{{ route('dthistdoc.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="doc_id" class="form-label">Doc Name</label>
                <select id="doc-select" name="doc_id" class="form-select @error('doc_id') is-invalid @enderror">
                    @foreach ($documents as $document)
                        <option value="{{ $document->id }}">{{ $document->id }} - {{ $document->description }} - {{ $document->doc_name }} - {{ $document->iso->description }}</option>
                    @endforeach
                </select>
                @error('doc_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tgl_berlaku" class="form-label">Tanggal Berlaku</label>
                <input type="date" name="tgl_berlaku" class="form-control @error('tgl_berlaku') is-invalid @enderror" id="tgl_berlaku">
                @error('tgl_berlaku')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isiFile" class="form-label">Select Doc PDF:</label>
                <input type="file" name="isiFile" class="form-control @error('isiFile') is-invalid @enderror" accept=".pdf">
                @error('isiFile')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="revisi_isi" class="form-label">Revisi Doc:</label>
                <input type="text" name="revisi_isi" class="form-control @error('revisi_isi') is-invalid @enderror">
                @error('revisi_isi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
