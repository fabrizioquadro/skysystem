<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ferramenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'estoque_id',
        'nm_ferramenta',
        'ds_ferramenta',
        'vl_ferramenta',
        'st_ferramenta',
        'ds_motivo_baixa',
    ];

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }
}
