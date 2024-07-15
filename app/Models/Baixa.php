<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baixa extends Model
{
    use HasFactory;

    protected $fillable = [
        'dt_baixa',
        'ds_motivo',
    ];

    static public function getBaixasRelatorios($produto_id, $dt_inc, $dt_fn){
        $sql = "SELECT baixa_produtos.baixa_id, baixa_produtos.produto_id,
        baixa_produtos.qt_produto, baixas.dt_baixa, baixas.ds_motivo
        FROM baixa_produtos, baixas WHERE 1=1";
        $dados = array();
        if($produto_id){
            $sql .= " AND baixa_produtos.produto_id=?";
            $dados[] = $produto_id;
        }
        $sql .= " AND baixa_produtos.baixa_id=baixas.id";
        if($dt_inc){
            $sql .= " AND baixas.dt_baixa>=?";
            $dados[] = $dt_inc;
        }
        if($dt_fn){
            $sql .= " AND baixas.dt_baixa<=?";
            $dados[] = $dt_fn;
        }

        $sql .= " ORDER BY baixas.dt_baixa";

        return \DB::select($sql, $dados);

    }
}
