<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'CodVenda',
        'CodEntrega',
        'Cliente',
        'DataEntrega',
        'DataVenda',
        'ValorTotal'
    ];

    public function tipoEntregas() 
    {
        return $this->belongsTo(tipoEntrega::class, 'CodEntrega');
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produtoVenda', 'CodVenda', 'CodProduto')
                    ->withPivot('QtdVenda', 'ValorUnitario', 'DataVenda');
    }

}
