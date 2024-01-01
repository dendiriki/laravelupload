<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DtHistLampiran extends Model
{
    protected $table = 'dt_histlampiran';

    protected $fillable = [
        'description', 'tgl_perubahan', 'tgl_berlaku', 'doc_id', 'revisi', 'id_sebelum', 'link_document', 'vc_created_user', 'comp_id', 'nodoc'
    ];

    public function previousRevision()
    {
        return $this->belongsTo(DtHistLampiran::class, 'id_sebelum', 'id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'vc_created_user', 'code_emp');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id');
    }
}
