<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DtHistDoc extends Model
{
    protected $table = 'dt_histdoc'; // Nama tabel sesuai dengan database Anda

    protected $fillable = [
        'description', 'tgl_perubahan', 'tgl_berlaku', 'doc_id', 'revisi', 'id_sebelum', 'link_document', 'vc_created_user', 'comp_id', 'nodoc'
    ];

    // Relasi self-join ke revisi sebelumnya
    public function previousRevision()
    {
        return $this->belongsTo(DtHistDoc::class, 'id_sebelum', 'id');
    }

    // Relasi ke model Document
    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

    // Relasi ke model User (vc_created_user)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'vc_created_user', 'code_emp');
    }

    // Relasi ke model Company (comp_id)
    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id');
    }
}
