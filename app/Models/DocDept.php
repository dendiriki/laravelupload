<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocDept extends Model
{
    protected $table = 'doc_dept'; // Sesuaikan dengan nama tabel yang sudah ada
    protected $fillable = ['doc_id', 'dep_id'];
    public $timestamps = false; // Menonaktifkan fitur timestamps

    public function scopeFilter($query)
{
    if (request('search')) {
        return $query->whereHas('document', function ($subquery) {
            $subquery->where('description', 'like', '%' . request('search') . '%');
        });
    }
}


    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

    public function dep()
    {
        return $this->belongsTo(Dep::class, 'dep_id');
    }
}
