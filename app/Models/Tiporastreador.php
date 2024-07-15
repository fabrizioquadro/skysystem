<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiporastreador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_tipo_rastreador',
    ];

    public function modelos(){
        return $this->hasMany(Modelorastreador::class,'tiporastreador_id','id');
    }

    static public function busca_tipos_marca($marca_id){
        $sql = "SELECT DISTINCT tiporastreadors.id, tiporastreadors.nm_tipo_rastreador
        FROM modelorastreadors, tiporastreadors
        WHERE modelorastreadors.marca_id=? AND
        modelorastreadors.tiporastreador_id=tiporastreadors.id
        ORDER BY nm_tipo_rastreador;
        ";
        $array = array();
        $array[] = $marca_id;
        return \DB::select($sql, $array);
    }
}
