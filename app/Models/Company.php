<?php

// app/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company'; // Specify the table name

    protected $guarded = [];

    public $timestamps = false; // Menonaktifkan fitur timestamps

    public function isos()
    {
        return $this->hasMany(ISO::class, 'comp_id');
    }
}

