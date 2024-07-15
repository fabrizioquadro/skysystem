<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstalacaoFerramenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'instalacao_id',
        'ferramenta_id',
        'estoque_id',
    ];

    public function ferramenta(){
        return $this->belongsTo(Ferramenta::class);
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }
}
