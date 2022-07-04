<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;
    protected $table = 'forma_pagamento';


    public  function scopePesquisaPorNome($query, $nome)
    {
        return $query->where('nome', 'LIKE', '%' . $nome . '%')->paginate(config('app.pageLimit'));
    }
}
