<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $table = 'hak_akses';
    
    protected $fillable = [
        'id_user',
        'id_menu',
        'lihat',
        'beranda', 
        'tambah',
        'edit',
        'hapus'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}