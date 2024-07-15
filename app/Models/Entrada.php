<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'dt_entrada',
        'nm_fornecedor',
        'nr_notafiscal',
    ];

    static public function getEntradasFiltoRelatorio($produto_id, $dt_inc, $dt_fn){
        $sql = "SELECT entradaprodutos.entrada_id, entradaprodutos.produto_id,
        entradaprodutos.estoque_id, entradaprodutos.qt_produto, entradaprodutos.vl_produto,
        entradas.dt_entrada, entradas.nm_fornecedor, entradas.nr_notafiscal 
        FROM entradaprodutos, entradas WHERE 1=1";
        $dados = array();

        if($produto_id){
            $sql .= " AND entradaprodutos.produto_id=?";
            $dados[] = $produto_id;
        }

        $sql .= " AND entradaprodutos.entrada_id=entradas.id";

        if($dt_inc){
            $sql .= " AND entradas.dt_entrada>=?";
            $dados[] = $dt_inc;
        }

        if($dt_fn){
            $sql .= " AND entradas.dt_entrada<=?";
            $dados[] = $dt_fn;
        }

        $sql .= " ORDER BY entradas.dt_entrada";

        return \DB::select($sql, $dados);
    }
}
