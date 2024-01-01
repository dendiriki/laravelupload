<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'mst_document';
    protected $guarded = [];
    public $timestamps = false; // Menonaktifkan fitur timestamps

    public function type()
    {
        return $this->belongsTo(Type::class, 'doctype_id');
    }

    public function iso()
    {
        return $this->belongsTo(ISO::class, 'iso_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'vc_created_user', 'code_emp');
    }

    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'vc_modified_user', 'code_emp');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id');
    }
}
