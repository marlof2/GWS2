<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['nome', 'quantidade'];


    public  function scopePesquisaPorNome($query, $nome)
    {
        return $query->where('nome', 'LIKE', '%' . $nome . '%')->paginate(config('app.pageLimit'));
    }

    public function retiraDoEstoque($request)
    {
        $product =  Product::find($request['product_id']);
        $product->quantidade = $product->quantidade - $request['quantidade'];
        $product->save();

        return 'Retirado com sucesso';
    }

    public function adicionaNoEstoque($quantAnterior, $request)
    {
        $product =  Product::find($request['product_id']);

        if ($quantAnterior) {
            $product->quantidade = $product->quantidade + $quantAnterior;
        } else {
            $product->quantidade = $product->quantidade +  $request['quantidade'];
        }
        $product->save();

        return 'Adicionado com sucesso';
    }
}
