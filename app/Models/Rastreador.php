<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rastreador extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_rastreador',
        'marca_id',
        'tiporastreador_id',
        'modelorastreador_id',
        'st_rastreador',
        'ds_motivo_baixa',
        'simcard_id',
        'estoque_id',
        'veiculo_id',
    ];

    public function simcard(){
        return $this->belongsTo(Simcard::class,'simcard_id');
    }

    public function tipo(){
        return $this->belongsTo(Tiporastreador::class,'tiporastreador_id');
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function modelo(){
        return $this->belongsTo(Modelorastreador::class,'modelorastreador_id');
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class,'estoque_id');
    }

    public function veiculo(){
        return $this->belongsTo(Veiculo::class,'veiculo_id');
    }
}
