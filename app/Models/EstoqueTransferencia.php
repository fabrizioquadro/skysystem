<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstoqueTransferencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'origem_estoque_id',
        'destino_estoque_id',
        'qt_produto',
        'dt_transferencia',
    ];

    public function origem(){
        return $this->belongsTo(Estoque::class, 'origem_estoque_id');
    }

    public function destino(){
        return $this->belongsTo(Estoque::class, 'destino_estoque_id');
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    static public function getTransferenciasRelatorios($estoque_id, $produto_id, $dt_inc, $dt_fn){
        $sql = "SELECT id FROM estoque_transferencias
        WHERE 1 = 1";
        $dados = array();
        if($estoque_id){
            $sql .= " (AND origem_estoque_id=? OR destino_estoque_id=?)";
            $dados[] = $estoque_id;
            $dados[] = $estoque_id;
        }
        if($produto_id){
            $sql .= " AND produto_id=?";
            $dados[] = $produto_id;
        }
        if($dt_inc){
            $sql .= " AND dt_transferencia>=?";
            $dados[] = $dt_inc;
        }
        if($dt_fn){
            $sql .= " AND dt_transferencia<=?";
            $dados[] = $dt_fn;
        }

        $sql .= " ORDER BY dt_transferencia";

        return \DB::select($sql, $dados);
    }
}
