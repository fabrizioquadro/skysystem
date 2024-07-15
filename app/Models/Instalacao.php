<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'veiculo_id',
        'rastreador_id',
        'simcard_id',
        'user_id',
        'dt_instalacao',
        'dt_desinstalacao',
        'st_instalacao',
        'ds_obs',
        'ds_obs_desinstalacao',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function veiculo(){
        return $this->belongsTo(Veiculo::class);
    }

    public function rastreador(){
        return $this->belongsTo(Rastreador::class);
    }

    public function simcard(){
        return $this->belongsTo(Simcard::class);
    }

    static public function getValoresFerramentasClientes($cliente_id, $st_instalacao){
        $sql = "SELECT SUM(ferramentas.vl_ferramenta) AS vl_ferramenta FROM
        ferramentas, instalacao_ferramentas, instalacaos WHERE
        ferramentas.id=instalacao_ferramentas.ferramenta_id AND
        instalacao_ferramentas.instalacao_id=instalacaos.id AND
        instalacaos.cliente_id=? AND instalacaos.st_instalacao=?;
        ";
        $dados = [$cliente_id,$st_instalacao];

        $result = \DB::select($sql, $dados);
        $result = collect($result)->first();

        return $result->vl_ferramenta;
    }

    static public function getValoresFerramentasVeiculo($veiculo_id, $st_instalacao){
        $sql = "SELECT SUM(ferramentas.vl_ferramenta) AS vl_ferramenta FROM
        ferramentas, instalacao_ferramentas, instalacaos WHERE
        ferramentas.id=instalacao_ferramentas.ferramenta_id AND
        instalacao_ferramentas.instalacao_id=instalacaos.id AND
        instalacaos.veiculo_id=? AND instalacaos.st_instalacao=?;
        ";
        $dados = [$veiculo_id,$st_instalacao];

        $result = \DB::select($sql, $dados);
        $result = collect($result)->first();

        return $result->vl_ferramenta;
    }

    static public function getRelatorios($cliente_id, $veiculo_id, $rastreador_id, $simcard_id, $dt_inc_instalacao, $dt_fn_instalacao, $dt_inc_desinstalacao, $dt_fn_desinstalacao, $st_instalacao){
        $sql = "SELECT id FROM instalacaos WHERE 1=1";
        $dados = array();

        if($cliente_id){
            $sql .= " AND cliente_id=?";
            $dados[] = $cliente_id;
        }
        if($veiculo_id){
            $sql .= " AND veiculo_id=?";
            $dados[] = $veiculo_id;
        }

        if($rastreador_id){
            $sql .= " AND rastreador_id=?";
            $dados[] = $rastreador_id;
        }

        if($simcard_id){
            $sql .= " AND simcard_id=?";
            $dados[] = $simcard_id;
        }

        if($dt_inc_instalacao){
            $sql .= " AND dt_instalacao>=?";
            $dados[] = $dt_inc_instalacao;
        }

        if($dt_fn_instalacao){
            $sql .= " AND dt_instalacao<=?";
            $dados[] = $dt_fn_instalacao;
        }

        if($dt_inc_desinstalacao){
            $sql .= " AND dt_desinstalacao>=?";
            $dados[] = $dt_inc_desinstalacao;
        }

        if($dt_fn_desinstalacao){
            $sql .= " AND dt_desinstalacao<=?";
            $dados[] = $dt_fn_desinstalacao;
        }

        if($st_instalacao){
            $sql .= " AND st_instalacao=?";
            $dados[] = $st_instalacao;
        }

        $sql .= " ORDER BY dt_instalacao";

        return \DB::select($sql, $dados);

    }

}
