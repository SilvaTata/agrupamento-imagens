<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'CodProduto',
        'CodCatProduto',
        'Nome',
        'Descricao',
        'ValorUnitario',
        'QtdEstoque'
    ];


    public function categoriaProdutos() 
    {
        return $this->belongsTo(categoriaProduto::class, 'CodCatProduto');
    }

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'produtoVenda', 'CodProduto', 'CodVenda')
                    ->withPivot('QtdVenda', 'ValorUnitario', 'DataVenda');
    }

}
