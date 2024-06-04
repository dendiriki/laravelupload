@extends('layouts.app')

@section('content')

    <style type="text/css" media="print">
        #pdf_container { display: none; }
        .print-message { display: block !important; }
    </style>

    <div id="pdf_container" tabindex="0">
        <object id="pdf_object" width="100%" height="800px" type="application/pdf" data="{{ asset('public/' . $iso->path . '/' . $iso->file_name) }}#toolbar=0">
            <p>Document load was not successful.</p>
        </object>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var pdfContainer = document.getElementById('pdf_container');
            var pdfObject = document.getElementById('pdf_object');

            // Mematikan menu pencetakan di objek PDF
            if (pdfObject.contentDocument) {
                pdfObject.contentDocument.addEventListener('keydown', function (e) {
                    // Mendeteksi tombol pintasan cetak (Ctrl + P di Windows/Linux, Command + P di Mac)
                    if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P')) {
                        // Mencegah aksi default (pencetakan)
                        e.preventDefault();
                        // Menampilkan pesan peringatan
                        alert('Printing is disabled');
                        return false;
                    }
                });
            }

            // Mematikan fungsi print
            window.addEventListener('keydown', function (e) {
                // Mendeteksi tombol pintasan cetak (Ctrl + P di Windows/Linux, Command + P di Mac)
                if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P')) {
                    // Mencegah aksi default (pencetakan)
                    e.preventDefault();
                    // Menampilkan pesan peringatan
                    alert('Printing is disabled');
                    return false;
                }
            });
        });

        // Mencegah menu konteks (klik kanan)
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
@endsection
