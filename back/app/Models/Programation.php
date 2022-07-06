<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programation extends Model
{
    use HasFactory;

    protected $table = 'programations';

    protected $fillable = [
        'valor', 
        'situacao',
        'observacao',
        'garantia',
        'data_hora',
        'forma_pagamento_id',
        'condominium_id',
        'user_id',
        'client_id',
    ];


    public function cliente()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function condominio()
    {
        return $this->belongsTo(Condominium::class, 'condominium_id', 'id')->select('id','nome');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id','name');
    }

    public  function scopePesquisaPorNome($query, $nome)
    {
        return $query->where('nome', 'LIKE', '%' . $nome . '%')->paginate(config('app.pageLimit'));
    }

    public function produtos()
    {
        return $this->belongsToMany(Product::class, 'programation_products', 'programation_id', 'product_id')->select('id','nome','programation_products.quantidade');
    }

    
}
