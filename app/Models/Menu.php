<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'id_parent',
        'title', 
        'route_name',
        'icon',
        'urutan',
        'lihat',
        'tambah',
        'edit',
        'hapus'
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'id_parent', 'id')->orderBy('urutan');
    }
}