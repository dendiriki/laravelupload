<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dep extends Model
{
    protected $table = 'dep'; // Sesuaikan dengan nama tabel yang sudah ada
    protected $fillable = ['name', 'short', 'com_id'];
    public $timestamps = false; // Menonaktifkan fitur timestamps

   // Di dalam model Dep
    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id');
    }

}


