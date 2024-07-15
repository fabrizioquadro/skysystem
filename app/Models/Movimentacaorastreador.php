<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacaorastreador extends Model
{
    use HasFactory;

    protected $fillable = [
        'rastreador_id',
        'user_id',
        'ds_movimentacao',
    ];

    public static function pesq_movimentacao($rastreador_id, $dt_inc, $dt_fn){
        $array = array();
        $sql = "SELECT *, movimentacaorastreadors.created_at AS dt_mov
        FROM movimentacaorastreadors
        LEFT JOIN users ON (movimentacaorastreadors.user_id = users.id)
        WHERE movimentacaorastreadors.rastreador_id=?";
        $array[] = $rastreador_id;

        if($dt_inc){
            $dt_inc = $dt_inc." 00:00:00";
            $sql .= " AND movimentacaorastreadors.created_at>=?";
            $array[] = $dt_inc;
        }

        if($dt_fn){
            $dt_fn = $dt_fn." 23:59:59";
            $sql .= " AND movimentacaorastreadors.created_at<=?";
            $array[] = $dt_fn;
        }

        $sql .= " ORDER BY movimentacaorastreadors.id";

        return \DB::SELECT($sql, $array);
    }
}
