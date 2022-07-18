<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf_cnpj','cep', 'endereco', 'complemento', 'cidade', 'bairro','telefone', 'email'];


    public  function scopePesquisaPorNome($query, $nome)
    {
        return $query->where('nome', 'LIKE', '%' . $nome . '%')->paginate(config('app.pageLimit'));
    }

    // public function programacao()
    // {
    //     return $this->hasMany(Programation::class);
    // }
}
