{{-- resources/views/dthistdoc/edit.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit DtHistDoc</h2>
        <form action="{{ route('dthistdoc.update', $dtHistDoc->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="doc_id" class="form-label">Doc Name</label>
                <select id="doc_id" name="doc_id" class="form-select">
                    @if ($documents)
                        <option value="{{ $documents->id }}">{{ $documents->description }}</option>
                    @else
                        <option value="">Dokumen tidak ditemukan</option>
                    @endif
                </select>
            </div>



            <div class="mb-3">
                <label for="description" class="form-label">No Doc</label>
                <input type="text" name="description" class="form-control" value="{{ $documents->description }}">
            </div>


            <div class="mb-3">
                <label for="dt_modified_date" class="form-label">Date</label>
                <input type="date" name="dt_modified_date" class="form-control">
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
                <label for="coverFile" class="form-label">Select Cover PDF:</label>
                <input type="file" name="coverFile" class="form-control" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="revisi_cover" class="form-label">Revisi Cover:</label>
                <input type="text" name="revisi_cover" class="form-control">
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Revernsi Cover</label>
                <select id="cover" name="cover" class="form-select">
                    @foreach ($cover as $c)
                        <option value="{{ $c->id }}">{{ $c->document->description }} - {{ $c->revisi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="isiFile" class="form-label">Select Isi PDF:</label>
                <input type="file" name="isiFile" class="form-control" accept=".pdf" required>
            </div>

            <div class="mb-3">
                <label for="revisi_isi" class="form-label">Revisi Doc:</label>
                <input type="text" name="revisi_isi" class="form-control">
            </div>

            <div class="mb-3">
                <label for="doc" class="form-label">Revernsi Doc</label>
                <select id="doc" name="doc" class="form-select">
                    @foreach ($doc as $d)
                        <option value="{{ $d->id }}">{{ $d->document->description }} - {{ $d->revisi }}
                        </option>
                    @endforeach
                </select>
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
                <label for="lampiran" class="form-label">Revernsi Attachment</label>
                <select id="lampiran" name="lampiran" class="form-select">
                    @foreach ($lampiran as $l)
                        <option value="{{ $l->id }}">{{ $l->document->description }} - {{ $l->revisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="recordFile" class="form-label">Select Record PDF:</label>
                <input type="file" name="recordFile" class="form-control" accept=".pdf">
            </div>

            <div class="mb-3">
                <label for="revisi_record" class="form-label">Revisi Record:</label>
                <input type="text" name="revisi_record" class="form-control">
            </div>

            <div class="mb-3">
                <label for="catmut" class="form-label">Revernsi Record</label>
                <select id="catmut" name="catmut" class="form-select">
                    @foreach ($catmut as $mut)
                        <option value="{{ $mut->id }}">{{ $mut->document->description }} - {{ $mut->revisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>

        <!-- Tombol Delete -->
        <form action="{{ route('dthistdoc.destroy', $dtHistDoc->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>
@endsection
