<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopePesquisaPorNome($query, $nome)
    {
        return $query->where('name', 'LIKE', '%' . $nome . '%')->paginate(config('app.pageLimit'));
    }

    public function permissao()
    {
        return $this->belongsToMany(Permissao::class,'papel_permissao', 'papel_id', 'permissao_id')->select('id', 'nome');
    }

    public function papel()
    {
        return $this->belongsToMany(Papel::class, 'papel_users', 'user_id', 'papel_id')->select('id', 'nome');
    }
}
