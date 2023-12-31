<?php

// app/ISO.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ISO extends Model
{
    protected $table = 'mst_iso'; // Specify the table name

    protected $guarded = [];

    public $timestamps = false; // Menonaktifkan fitur timestamps

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
