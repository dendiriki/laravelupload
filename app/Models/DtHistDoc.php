<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DtHistDoc extends Model
{
    protected $table = 'dt_histdoc'; // Nama tabel sesuai dengan database Anda

    protected $fillable = [
        'description', 'tgl_perubahan', 'tgl_berlaku', 'doc_id', 'revisi', 'id_sebelum', 'link_document', 'vc_created_user', 'comp_id', 'nodoc','doc_name','sequence'
    ];

    public function scopeFilter($query)
    {
        if (request('search')) {
            $query->where('description', 'like', '%' . request('search') . '%');
        }
    
        // Filter berdasarkan ISO
        if (request('iso')) {
            $query->whereHas('document', function ($query) {
                $query->where('iso_id', request('iso'));
            });
        }
    
        // Tambahkan filter berdasarkan Departemen (dep_terkait)
        if (request('dep')) {
            $query->whereHas('document', function ($query) {
                // Asumsikan 'dep_terkait' berisi singkatan seperti "COM", "MKT", dll.
                $query->where('dep_terkait', request('dep'));
            });
        }
    
        // Tambahkan filter berdasarkan Company (comp_id)
        if (request('company')) {
            $query->whereHas('company', function ($query) {
                $query->where('id', request('company'));
            });
        }
    
        return $query;
    }
    


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
