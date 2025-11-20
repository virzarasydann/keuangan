<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hakAkses()
    {
        return $this->hasMany(HakAkses::class, 'id_user');
    }

    // Method untuk mendapatkan menu yang boleh diakses
    public function menus()
    {
        return $this->hasManyThrough(
            Menu::class,
            HakAkses::class,
            'id_user', // Foreign key pada HakAkses
            'id', // Foreign key pada Menu  
            'id', // Local key pada User
            'id_menu' // Local key pada HakAkses
        )->where('hak_akses.lihat', 1);
    }
}
