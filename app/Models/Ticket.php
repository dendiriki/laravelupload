<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket'; // Sesuaikan dengan nama tabel yang sudah ada

    public $timestamps = false; // Menonaktifkan fitur timestamps

    protected $fillable = [
        'user_id', 'department_id', 'company_id', 'document_name', 'document_file', 'document_status', 'document_note','tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'code_emp');
    }

    public function department()
    {
        return $this->belongsTo(Dep::class, 'department_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
