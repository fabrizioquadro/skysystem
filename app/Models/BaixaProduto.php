<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaixaProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'baixa_id',
        'produto_id',
        'estoque_id',
        'qt_produto',
    ];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }
}
