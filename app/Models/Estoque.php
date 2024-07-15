<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_estoque',
        'ds_local',
        'nr_cnpj_cpf',
        'ds_email',
        'nr_tel',
        'nr_cel',
        'st_estoque_adm',
    ];

    static public function setEstoquesNao(){
        \DB::table('estoques')
        ->update(['st_estoque_adm' => 'Não']);
    }

    static public function getEstoqueAdm(){
        $sql = "SELECT * FROM estoques WHERE st_estoque_adm='Sim' limit 1";
        return collect(\DB::select($sql))->first();
    }

    static public function getEstoqueProduto($estoque_id, $produto_id){
        $qt_entradas = \DB::table('entradaprodutos')
            ->where('estoque_id', $estoque_id)
            ->where('produto_id', $produto_id)
            ->sum('qt_produto');

        $qt_baixas = \DB::table('baixa_produtos')
            ->where('estoque_id', $estoque_id)
            ->where('produto_id', $produto_id)
            ->sum('qt_produto');

        $qt_trans_entradas = \DB::table('estoque_transferencias')
            ->where('produto_id', $produto_id)
            ->where('destino_estoque_id', $estoque_id)
            ->sum('qt_produto');

        $qt_trans_saidas = \DB::table('estoque_transferencias')
            ->where('produto_id', $produto_id)
            ->where('origem_estoque_id', $estoque_id)
            ->sum('qt_produto');

        $qt_prod_utilizados = \DB::table('instalacao_produtos')
            ->where('produto_id', $produto_id)
            ->where('estoque_id', $estoque_id)
            ->where('st_produto', 'Instalado')
            ->sum('qt_produto');

        return ($qt_entradas + $qt_trans_entradas) - ($qt_baixas + $qt_trans_saidas + $qt_prod_utilizados);
    }
}
