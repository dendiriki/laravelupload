@extends('layouts.app')

@section('content')

    <object width="100%" height="800px" type="application/pdf" data="{{ asset("storage/" . $lampiran->link_document) }}#toolbar=0" id="pdf_content">
    <p>Document load was not successful.</p>
     </object>';

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.207/pdf.min.js"></script>

   <!-- Tambahkan script Bootstrap JS (Opsional) -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
   <script>
       function blockPrintShortcut(e) {
       // Mendeteksi tombol pintasan cetak (Ctrl + P di Windows/Linux, Command + P di Mac)
       if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P')) {
           // Mencegah aksi default (pencetakan)
           e.preventDefault();
           // Menampilkan pesan peringatan
           alert('Printing is disabled');
           return false;
       }
   }

   document.getElementById('pdf_content').addEventListener('keydown', blockPrintShortcut);
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
