<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relacionamentoProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'CodProduto1',
        'CodProduto2',
        'CodCatRelacionamento'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaProduto::class, 'CodCatRelacionamento');
    }
}
