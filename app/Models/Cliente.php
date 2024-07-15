<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_cliente',
        'tp_pessoa',
        'nr_cnpjcpf',
        'nr_rgie',
        'nr_tel',
        'nr_cel',
        'ds_email',
        'nr_cep',
        'ds_endereco',
        'nr_endereco',
        'ds_complemento',
        'ds_bairro',
        'nm_cidade',
        'ds_uf',
        'ds_obs',
        'nm_contato',
        'nr_telcontato',
        'nr_celcontato',
        'ds_emailcontato',
    ];

    public function veiculos(){
        return $this->hasMany(Veiculo::class);
    }
}
