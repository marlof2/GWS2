<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    use HasFactory;

    protected $table = 'papeis';


    public function permissao()
    {
        return $this->belongsToMany(Permissao::class, 'papel_permissao', 'permissao_id', 'papel_id');
    }
}
