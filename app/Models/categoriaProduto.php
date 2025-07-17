<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoriaProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'CatRelacionamento'
    ];


    public function relacionamentoProdutos()
    {
        return $this->belongsTo(relacionamentoProduto::class);
    }
}
