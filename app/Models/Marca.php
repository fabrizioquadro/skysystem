<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_marca',
        'tp_marca',
    ];

    static public function getMarcaProdutosFerramentas(){
        return \DB::table('marcas')
        ->where('tp_marca', 'Produto/Ferramentas')
        ->orderBy('nm_marca')
        ->get();
    }

    static public function getMarcaVeiculos(){
        return \DB::table('marcas')
        ->where('tp_marca', 'Veículo')
        ->orderBy('nm_marca')
        ->get();
    }

    static public function getMarcaRastreadores(){
        return \DB::table('marcas')
        ->where('tp_marca', 'Rastreador')
        ->orderBy('nm_marca')
        ->get();
    }

    public function produtos(){
        return $this->hasMany(Produto::class);
    }

    public function ferramentas(){
        return $this->hasMany(Ferramenta::class);
    }

    public function modeloRastreadores(){
        return $this->hasMany(Modelorastreador::class);
    }
}
