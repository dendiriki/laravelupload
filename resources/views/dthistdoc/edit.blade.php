{{-- resources/views/dthistdoc/edit.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Revisi Document</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('dthistdoc.update', $dtHistDoc->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="doc_id" class="form-label">Doc Name</label>
                <select id="doc_id" name="doc_id" class="form-select">
                    @if ($document)
                        <option value="{{ $document->id }}">{{ $document->description }}</option>
                    @else
                        <option value="">Dokumen tidak ditemukan</option>
                    @endif
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">No Doc</label>
                <input type="text" name="description" class="form-control" value="{{ $document ? $document->description : '' }}">
            </div>

            <div class="mb-3">
                <label for="tgl_berlaku" class="form-label">Tanggal Berlaku</label>
                <input type="date" name="tgl_berlaku" class="form-control @error('isiFile') is-invalid @enderror" id="tgl_berlaku"  value="{{ $dtHistDoc->tgl_berlaku }}">
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
                <input type="text" name="revisi_isi" class="form-control @error('isiFile') is-invalid @enderror" value="{{ $dtHistDoc->revisi }}">
                @error('revisi_isi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="doc" class="form-label">Referensi Doc</label>
                <select id="doc" name="doc" class="form-select" onfocus='this.size=8;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    @foreach ($dtHistDocs as $d)
                        <option value="{{ $d->id }}">{{ $d->document->description }} - {{ $d->revisi }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
@endsection
