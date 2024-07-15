<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelorastreador extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'tiporastreador_id',
        'nm_modelo',
    ];

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function tipo(){
        return $this->belongsTo(Tiporastreador::class,'tiporastreador_id');
    }
}
