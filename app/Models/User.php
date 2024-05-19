<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Menyatakan nama tabel yang digunakan

    protected $primaryKey = 'code_emp'; // Menyatakan primary key tabel

    public $incrementing = false; // Menyatakan apakah primary key auto-increment atau tidak

    protected $fillable = [
        'code_emp', 'username', 'password', 'role', 'dep_id', 'comp_id','status','document_number',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department()
    {
        return $this->belongsTo(Dep::class, 'dep_id');
    }

    public function documents()
    {
        return Document::where('id', $this->dep_id)->get();
    }

    public function comp()
    {
        return $this->belongsTo(company::class, 'comp_id');
    }


    // Definisikan relasi ke tabel departemen
    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'dep_id', 'id');
    // }

    // Definisikan relasi ke tabel company
    // public function company()
    // {
    //     return $this->belongsTo(Company::class, 'comp_id', 'id');
    // }
}
