<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Ferramenta;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Instalacao;
use App\Models\Simcard;
use App\Models\Rastreador;
use App\Models\Entrada;
use App\Models\Baixa;
use App\Models\EstoqueTransferencia;

class RelatoriosController extends Controller
{
    public function estoques(){
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('relatorios/estoques', compact('estoques'));
    }

    public function estoques_gerar(Request $request){
        $estoque = Estoque::where('id', $request->get('estoque_id'))->first();
        $ferramentas = Ferramenta::where('estoque_id', $estoque->id)->orderBy('nm_ferramenta')->get();

        //vamos ver os produtos que possui este estoque
        $produtos = Produto::all()->sortBy('nm_produto');
        $array_produtos = array();

        foreach($produtos as $produto){
            $quantidade_estoque = Estoque::getEstoqueProduto($estoque->id, $produto->id);
            if($quantidade_estoque > 0){
                $array = array();
                $array['nm_produto'] = $produto->nm_produto;
                $array['nm_marca'] = $produto->marca->nm_marca;
                $array['ds_unidade'] = $produto->ds_unidade;
                $array['qt_produto'] = $quantidade_estoque;
                $array['vl_produto'] = $produto->getUltimoValorInserido();
                $array_produtos[] = $array;
            }
        }

        return view('relatorios/estoques_gerar', compact('estoque','ferramentas','array_produtos'));
    }

    public function produtos(){
        $produtos = Produto::all()->sortBy('nm_produto');

        return view('relatorios/produtos', compact('produtos'));
    }

    public function produtos_gerar(Request $request){
        $produto = Produto::where('id', $request->get('produto_id'))->first();
        $estoques = Estoque::all()->sortBy('nm_estoque');
        $vl_produto =$produto->getUltimoValorInserido();

        $array_estoques = array();

        foreach($estoques as $estoque){
            $quantidade_estoque = Estoque::getEstoqueProduto($estoque->id, $produto->id);
            if($quantidade_estoque > 0){
                $array = array();
                $array['nm_estoque'] = $estoque->nm_estoque;
                $array['ds_unidade'] = $produto->ds_unidade;
                $array['qt_produto'] = $quantidade_estoque;
                $array['vl_produto'] = $vl_produto;
                $array_estoques[] = $array;
            }
        }

        return view('relatorios/produtos_gerar', compact('produto','array_estoques'));
    }

    public function clientes(){
        $clientes = Cliente::all()->sortBy('nm_cliente');

        return view('relatorios/clientes', compact('clientes'));
    }

    public function clientes_gerar(Request $request){
        if($request->get('cliente_id')){
            $clientes = Cliente::where('id', $request->get('cliente_id'))->get();
        }
        else{
            $clientes = Cliente::all()->sortBy('nm_cliente');
        }

        $array_clientes = array();

        foreach($clientes as $cliente){
            //vamos buscar o nr de veiculos desse cliente
            $nr_veiculos = Veiculo::where('cliente_id', $cliente->id)->count();
            $nr_intalacoes_totais = Instalacao::where('cliente_id', $cliente->id)->count();
            $nr_intalacoes_ativas = Instalacao::where('cliente_id', $cliente->id)
                ->where('st_instalacao', 'Instalado')
                ->count();
            $nr_intalacoes_desinstaladas = Instalacao::where('cliente_id', $cliente->id)
                ->where('st_instalacao', 'Desinstalado')
                ->count();

            $vl_ferramentas = Instalacao::getValoresFerramentasClientes($cliente->id, 'Instalado');

            $array = array();
            $array['nm_cliente'] = $cliente->nm_cliente;
            $array['nr_veiculos'] = $nr_veiculos;
            $array['nr_intalacoes_totais'] = $nr_intalacoes_totais;
            $array['nr_intalacoes_ativas'] = $nr_intalacoes_ativas;
            $array['nr_intalacoes_desinstaladas'] = $nr_intalacoes_desinstaladas;
            $array['vl_ferramentas'] = $vl_ferramentas;
            $array_clientes[] = $array;
        }

        return view('relatorios/clientes_gerar', compact('cliente','array_clientes'));
    }

    public function veiculos(){
        $clientes = Cliente::all()->sortBy('nm_veiculo');

        return view('relatorios/veiculos', compact('clientes'));
    }

    public function veiculos_gerar(Request $request){
        if($request->get('cliente_id')){
            $veiculos = Veiculo::where('cliente_id', $request->get('cliente_id'))->get();
        }
        else{
            $veiculos = Veiculo::all()->sortBy('cliente_id');
        }

        $array_veiculos = array();

        foreach($veiculos as $veiculo){
            $cliente = Cliente::where('id', $veiculo->cliente_id)->first();
            $nr_intalacoes_totais = Instalacao::where('veiculo_id', $veiculo->id)->count();
            $nr_intalacoes_ativas = Instalacao::where('veiculo_id', $veiculo->id)
                ->where('st_instalacao', 'Instalado')
                ->count();
            $nr_intalacoes_desinstaladas = Instalacao::where('veiculo_id', $veiculo->id)
                ->where('st_instalacao', 'Desinstalado')
                ->count();

            $vl_ferramentas = Instalacao::getValoresFerramentasVeiculo($veiculo->id, 'Instalado');

            $array = array();
            $array['nm_cliente'] = $cliente->nm_cliente;
            $array['nm_veiculo'] = $veiculo->marca->nm_marca." ".$veiculo->ds_modelo." ".$veiculo->nr_placa." Chassi:".$veiculo->nr_chassi;
            $array['nr_intalacoes_totais'] = $nr_intalacoes_totais;
            $array['nr_intalacoes_ativas'] = $nr_intalacoes_ativas;
            $array['nr_intalacoes_desinstaladas'] = $nr_intalacoes_desinstaladas;
            $array['vl_ferramentas'] = $vl_ferramentas;

            $array_veiculos[] = $array;
        }

        return view('relatorios/veiculos_gerar', compact('cliente','array_veiculos'));
    }

    public function simcards(){
        return view('relatorios/simcards');
    }

    public function simcards_gerar(Request $request){
        if($request->get('st_simcard')){
            $simcards = Simcard::where('st_simcard', $request->get('st_simcard'))->orderBy('id')->get();
        }
        else{
            $simcards = Simcard::all()->sortBy('id');
        }

        return view('relatorios/simcards_gerar', compact('simcards'));
    }

    public function rastreadores(){
        return view('relatorios/rastreadores');
    }

    public function rastreadores_gerar(Request $request){
        if($request->get('st_rastreador')){
            $rastreadores = Rastreador::where('st_rastreador',$request->get('st_rastreador'))->orderBy('cod_rastreador')->get();
        }
        else{
            $rastreadores = Rastreador::all()->sortBy('cod_rastreador');
        }

        return view('relatorios/rastreadores_gerar', compact('rastreadores'));
    }

    public function entradas(){
        $produtos = Produto::all()->sortBy('nm_produto');

        return view('relatorios/entradas', compact('produtos'));
    }

    public function entradas_gerar(Request $request){
        $entradas = Entrada::getEntradasFiltoRelatorio($request->get('produto_id'),$request->get('dt_inc'),$request->get('dt_fn'));

        $array_produtos = array();

        foreach($entradas as $entrada){
            $produto = Produto::where('id', $entrada->produto_id)->first();
            $array = array();
            $array['data'] = dataDbForm($entrada->dt_entrada);
            $array['fornecedor'] = $entrada->nm_fornecedor;
            $array['nota'] = $entrada->nr_notafiscal;
            $array['produto'] = $produto->nm_produto." ".$produto->marca->nm_marca;
            $array['quantidade'] = $entrada->qt_produto;
            $array['valor'] = $entrada->vl_produto;
            $array['total'] = $entrada->vl_produto * $entrada->qt_produto;
            $array_produtos[] = $array;
        }

        return view('relatorios/entradas_gerar', compact('array_produtos'));
    }

    public function baixas(){
        $produtos = Produto::all()->sortBy('nm_produto');

        return view('relatorios/baixas', compact('produtos'));
    }

    public function baixas_gerar(Request $request){
        $baixas = Baixa::getBaixasRelatorios($request->get('produto_id'), $request->get('dt_inc'),$request->get('dt_fn'));

        $array_produtos = array();

        foreach($baixas as $baixa){
            $produto = Produto::where('id', $baixa->produto_id)->first();
            $array = array();
            $array['data'] = dataDbForm($baixa->dt_baixa);
            $array['motivo'] = $baixa->ds_motivo;
            $array['produto'] = $produto->nm_produto." ".$produto->marca->nm_marca;
            $array['quantidade'] = $baixa->qt_produto;
            $array_produtos[] = $array;
        }

        return view('relatorios/baixas_gerar', compact('array_produtos'));
    }

    public function transferencias(){
        $estoques = Estoque::all()->sortBy('nm_estoque');
        $produtos = Produto::all()->sortBy('nm_produto');

        return view('relatorios/transferencias', compact('estoques','produtos'));
    }

    public function transferencias_gerar(Request $request){
        $transferencias = EstoqueTransferencia::getTransferenciasRelatorios($request->get('estoque_id'),$request->get('produto_id'),$request->get('dt_inc'),$request->get('dt_fn'));

        $array_transferencias = array();
        foreach($transferencias as $linha){
            $id = $linha->id;
            $transferencia = EstoqueTransferencia::where('id', $id)->first();
            $array_transferencias[] = $transferencia;
        }

        return view('relatorios/transferencias_gerar', compact('array_transferencias'));

    }

    public function instalacoes(){
        $clientes = Cliente::all()->sortBy('nm_cliente');
        $veiculos = Veiculo::all()->sortBy('id');
        $rastreadores = Rastreador::all()->sortBy('cod_rastreador');
        $simcards = Simcard::all()->sortBy('id');

        return view('relatorios/instalacoes', compact('clientes','veiculos','rastreadores','simcards'));
    }

    public function instalacoes_gerar(Request $request){
        $vars = Instalacao::getRelatorios(
            $request->get('cliente_id'),
            $request->get('veiculo_id'),
            $request->get('rastreador_id'),
            $request->get('simcard_id'),
            $request->get('dt_inc_instalacao'),
            $request->get('dt_fn_instalacao'),
            $request->get('dt_inc_desinstalacao'),
            $request->get('dt_fn_desinstalacao'),
            $request->get('st_instalacao'),
        );

        $array_instalacoes = array();
        foreach($vars as $linha){
            $instalacao = Instalacao::where('id', $linha->id)->first();

            $array_instalacoes[] = $instalacao;
        }

        return view('relatorios/instalacoes_gerar', compact('array_instalacoes'));
    }

}
