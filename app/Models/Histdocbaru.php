<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Histdocbaru extends Model
{
    protected $table = 'histdocbaru'; // Ganti dengan nama tabel view Anda
    // ...
    protected $guarded = [];
    public $timestamps = false;

    protected $fillable = [
        'lastdate'
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

    // Define fillable, relationships, or other configurations as needed
}
