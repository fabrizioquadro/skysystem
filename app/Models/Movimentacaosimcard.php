<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacaosimcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'simcard_id',
        'user_id',
        'ds_movimentacao',
    ];

    public static function pesq_movimentacao($simcard_id, $dt_inc, $dt_fn){
        $array = array();
        $sql = "SELECT *, movimentacaosimcards.created_at AS dt_mov
        FROM movimentacaosimcards
        LEFT JOIN users ON (movimentacaosimcards.user_id = users.id)
        WHERE movimentacaosimcards.simcard_id=?";
        $array[] = $simcard_id;

        if($dt_inc){
            $dt_inc = $dt_inc." 00:00:00";
            $sql .= " AND movimentacaosimcards.created_at>=?";
            $array[] = $dt_inc;
        }

        if($dt_fn){
            $dt_fn = $dt_fn." 23:59:59";
            $sql .= " AND movimentacaosimcards.created_at<=?";
            $array[] = $dt_fn;
        }

        $sql .= " ORDER BY movimentacaosimcards.id";

        return \DB::SELECT($sql, $array);
    }
}
