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

    public function excluir($dataAlteracao, $excluido, $id)
    {
        $produto = Product::find($id);
        $produto->data_alteracao = $dataAlteracao;
        $produto->excluido = $excluido;

        $produto->save();

        return $produto;
    }

    public function retiraDoEstoque($data, $product)
    {
        $product =  $product->find($data['product_id']);
        $product->quantidade = $product->quantidade - $data['quantidade'];
        $product->save();

        return 'Retirado com sucesso';
    }

    public function adicionaNoEstoque($data, $product)
    {

        $product =  $product->find($data['product_id']);
        $product->quantidade = $product->quantidade + $data['quantidade'];
        $product->save();

        return 'Adicionado com sucesso';
    }
}
