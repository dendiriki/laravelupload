<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dep extends Model
{
    protected $table = 'dep'; // Sesuaikan dengan nama tabel yang sudah ada
    protected $fillable = ['name', 'short'];
    public $timestamps = false; // Menonaktifkan fitur timestamps
}
