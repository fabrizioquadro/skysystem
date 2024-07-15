<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacaoferramenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'ferramenta_id',
        'ds_movimentacao',
        'user_id',
        'vl_manutencao',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function ferramenta(){
        return $this->belongsTo(Ferramenta::class,'ferramenta_id','id');
    }

    public static function pesq_movimentacao($ferramenta_id, $dt_inc, $dt_fn){
        $array = array();
        $sql = "SELECT *, movimentacaoferramentas.created_at AS dt_mov
        FROM movimentacaoferramentas
        LEFT JOIN users ON (movimentacaoferramentas.user_id = users.id)
        WHERE movimentacaoferramentas.ferramenta_id=?";
        $array[] = $ferramenta_id;

        if($dt_inc){
            $dt_inc = $dt_inc." 00:00:00";
            $sql .= " AND movimentacaoferramentas.created_at>=?";
            $array[] = $dt_inc;
        }

        if($dt_fn){
            $dt_fn = $dt_fn." 23:59:59";
            $sql .= " AND movimentacaoferramentas.created_at<=?";
            $array[] = $dt_fn;
        }

        $sql .= " ORDER BY movimentacaoferramentas.id";

        return \DB::SELECT($sql, $array);
    }
}
