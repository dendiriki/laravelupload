@extends('layouts.app')

@section('content')

    <style type="text/css" media="print">
        #pdf_container { display: none; }
        .print-message { display: block !important; }
    </style>

    <div id="pdf_container" tabindex="0">
        <object id="pdf_object" width="100%" height="800px" type="application/pdf" data="{{ asset("storage/" . $cover->link_document) }}#toolbar=0">
            <p>Document load was not successful.</p>
        </object>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.207/pdf.min.js"></script>

   <!-- Tambahkan script Bootstrap JS (Opsional) -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
   <script>
        window.addEventListener('keydown', function (event) {
        if ((event.ctrlKey || event.metaKey) && event.keyCode === 80 && !event.altKey && (!event.shiftKey || window.chrome || window.opera)) {
            event.preventDefault();
            // Menampilkan pesan peringatan
            alert('Printing is disabled');
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        var pdfContainer = document.getElementById('pdf_container');
        var pdfObject = document.getElementById('pdf_object');

        // Mematikan menu pencetakan di objek PDF
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
    });
   // Mendeteksi peristiwa tombol pintasan cetak
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
</script>
@endsection
