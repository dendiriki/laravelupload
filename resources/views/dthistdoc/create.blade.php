<!-- resources/views/dthistdoc/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah DtHistDoc</h2>
        <form action="{{ route('dthistdoc.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="doc_id" class="form-label">Doc Name</label>
                <select id="doc-select" name="doc_id" class="form-select" onfocus='this.size=8;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    @foreach ($documents as $document)
                        <option value="{{ $document->id }}">{{ $document->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Konfirmasi Doc Name</label>
                <input type="text" id="confirmation-input" name="description" class="form-control">
            </div>

            <div class="mb-3">
                <label for="doc_name" class="form-label">Nomer Doc Name</label>
                <input type="text" id="doc_name" name="doc_name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="vc_created_user" class="form-label">User Create</label>
                <select id="vc_created_user" name="vc_created_user" class="form-select">
                    @foreach ($users as $user)
                        <option value="{{ $user->code_emp }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="comp_id" class="form-label">Company</label>
                <select id="comp_id" name="comp_id" class="form-select">
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->short }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tgl_berlaku" class="form-label">Tanggal Berlaku</label>
                <input type="date" name="tgl_berlaku" class="form-control" id="tgl_berlaku">
            </div>

            <div class="mb-3">
                <label for="coverFile" class="form-label">Select Cover PDF:</label>
                <input type="file" name="coverFile" class="form-control" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="revisi_cover" class="form-label">Revisi Cover:</label>
                <input type="text" name="revisi_cover" class="form-control">
            </div>

            <div class="mb-3">
                <label for="isiFile" class="form-label">Select Doc PDF:</label>
                <input type="file" name="isiFile" class="form-control" accept=".pdf" required>
            </div>

            <div class="mb-3">
                <label for="revisi_isi" class="form-label">Revisi Doc:</label>
                <input type="text" name="revisi_isi" class="form-control">
            </div>

            <div class="mb-3">
                <label for="attachmentFile" class="form-label">Select Attachment PDF:</label>
                <input type="file" name="attachmentFile" class="form-control" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="revisi_attachment" class="form-label">Revisi Attachment:</label>
                <input type="text" name="revisi_attachment" class="form-control">
            </div>

            <div class="mb-3">
                <label for="recordFile" class="form-label">Select Record PDF:</label>
                <input type="file" name="recordFile" class="form-control" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="revisi_record" class="form-label">Revisi Record:</label>
                <input type="text" name="revisi_record" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('doc-select').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var confirmationInput = document.getElementById('confirmation-input');

            if (selectedOption) {
                confirmationInput.value = selectedOption.textContent;
            } else {
                confirmationInput.value = ''; // Atau nilai default jika tidak ada pilihan yang dipilih.
            }
        });
    </script>

@endsection
