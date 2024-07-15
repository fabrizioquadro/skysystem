<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'marca_id',
        'ds_modelo',
        'nr_placa',
        'nr_chassi',
        'st_veiculo',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function instalacoes(){
        return $this->hasMany(Instalacao::class);
    }

    public function instalacoesAtivas(){
        return \DB::table('instalacaos')
            ->where('veiculo_id', $this->id)
            ->where('st_instalacao','Instalado')
            ->count();
    }

}
