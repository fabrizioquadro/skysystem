<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'operadora_id',
        'nr_tel',
        'nr_icc',
        'st_simcard',
        'ds_motivo_baixa',
    ];

    public function rastreador(){
        return $this->hasOne(Rastreador::class);
    }

    public function operadora(){
        return $this->belongsTo(Operadora::class);
    }
}
