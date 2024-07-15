<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'nm_produto',
        'ds_unidade',
        'ds_produto',
        'ds_obs',
        'qt_minima',
    ];

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function getUltimoValorInserido(){
        $linha = \DB::table('entradaprodutos')
        ->where('produto_id', $this->id)
        ->orderByDesc('id')
        ->first();
        if($linha){
            return $linha->vl_produto;
        }
        else{
            return null;
        }
    }
}
