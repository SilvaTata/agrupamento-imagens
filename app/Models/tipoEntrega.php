<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoEntrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'CodEntrega',
        'Descricao'
    ];

    public function Venda() {
        return $this->hasMany(Venda::class);
    }
}
