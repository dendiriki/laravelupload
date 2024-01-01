<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'mst_doctype'; // Menentukan nama tabel yang digunakan

    protected $guarded = []; // Melindungi atribut yang tidak boleh mass-assignable

    public $timestamps = false; // Menonaktifkan fitur timestamps

    // Relasi ke model User
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'vc_created_user', 'code_emp');
    }

    // Relasi ke model User
    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'vc_modified_user', 'code_emp');
    }

    // Relasi ke model Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'comp_id');
    }
}
