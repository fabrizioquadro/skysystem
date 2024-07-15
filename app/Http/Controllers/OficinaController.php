<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Simcard;
use App\Models\Rastreador;
use App\Models\Estoque;
use App\Models\Instalacao;
use App\Models\InstalacaoProduto;
use App\Models\InstalacaoFerramenta;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Veiculo;
use App\Models\Ferramenta;

class OficinaController extends Controller
{
    public function simcards(){
        $simcards = Simcard::where('st_simcard','<>','Baixado')->orderBy('id')->get();

        return view('oficina/simcards', compact('simcards'));
    }

    public function simcards_desbloquear($id){
        $simcard = Simcard::where('id', $id)->first();

        return view('oficina/simcard_desbloquear', compact('simcard'));
    }

    public function simcards_desbloquear_set(Request $request){
        $simcard = Simcard::where('id', $request->get('simcard_id'))->first();
        $simcard->st_simcard = 'Desbloqueado';
        $simcard->save();

        $ds_movimentacao = "Simcard desbloqueado.";
        insertMovSimcard($simcard, $ds_movimentacao);

        return redirect()->route('oficina.simcards')->with('mensagem','Simcard desbloqueado');
    }

    public function simcards_baixar($id){
        $simcard = Simcard::where('id', $id)->first();

        return view('oficina/simcard_baixar', compact('simcard'));
    }

    public function simcards_baixar_set(Request $request){
        $simcard = Simcard::where('id', $request->get('simcard_id'))->first();
        $simcard->st_simcard = 'Baixado';
        $simcard->ds_motivo_baixa = $request->get('ds_motivo_baixa');
        $simcard->save();

        $ds_movimentacao = "Simcard baixado.";
        insertMovSimcard($simcard, $ds_movimentacao);

        return redirect()->route('oficina.simcards')->with('mensagem','Simcard baixado');
    }

    public function rastreadores(){
        $rastreadores = Rastreador::where('st_rastreador','<>','Baixado')->get();

        return view('oficina/rastreadores', compact('rastreadores'));
    }

    public function rastreadores_configurar($id){
        $rastreador = Rastreador::where('id', $id)->first();

        return view('oficina/rastreadores_configurar', compact('rastreador'));
    }

    public function rastreadores_configurar_set(Request $request){
        $rastreador = Rastreador::where('id', $request->get('rastreador_id'))->first();
        $rastreador->st_rastreador = 'Configurado';
        $rastreador->save();

        $ds_movimentacao = "Rastreador Configurado.";
        insertMovRastreador($rastreador, $ds_movimentacao);

        return redirect()->route('oficina.rastreadores')->with('mensagem','Rastreador Configurado!');
    }

    public function rastreadores_habilitar($id){
        $rastreador = Rastreador::where('id', $id)->first();
        $simcards = Simcard::where('st_simcard','Desbloqueado')->get();

        return view('oficina/rastreadores_habilitar', compact('rastreador','simcards'));
    }

    public function rastreadores_habilitar_set(Request $request){
        $rastreador = Rastreador::where('id', $request->get('rastreador_id'))->first();
        $simcard = Simcard::where('id', $request->get('simcard_id'))->first();

        $rastreador->simcard_id = $simcard->id;
        $rastreador->st_rastreador = 'Habilitado';
        $rastreador->save();

        $ds_movimentacao = "Rastreador Habilitado.";
        insertMovRastreador($rastreador, $ds_movimentacao);

        $simcard->st_simcard = "Vinculado";
        $simcard->save();
        $ds_movimentacao = "Simcard vinculado ao rastreador: <br>
        Cod: ".$rastreador->cod_rastreador."<br>
        Marca: ".$rastreador->marca->nm_marca."<br>
        Tipo: ".$rastreador->tipo->nm_tipo_rastreador."<br>
        Modelo: ".$rastreador->modelo->nm_modelo."<br>
        ";
        insertMovSimcard($simcard, $ds_movimentacao);

        return redirect()->route('oficina.rastreadores')->with('mensagem','Rastreador Habilitado!');
    }

    public function rastreadores_desabilitar($id){
        $rastreador = Rastreador::where('id', $id)->first();
        $simcard = Simcard::where('id',$rastreador->simcard_id)->first();

        return view('oficina/rastreadores_desabilitar', compact('rastreador','simcard'));
    }

    public function rastreadores_desabilitar_set(Request $request){
        $rastreador = Rastreador::where('id', $request->get('rastreador_id'))->first();
        $simcard = Simcard::where('id', $rastreador->simcard_id)->first();

        $rastreador->simcard_id = null;
        $rastreador->st_rastreador = 'Configurado';
        $rastreador->save();

        $ds_movimentacao = "Rastreador desabilitado do Simcard Id:".$simcard->id." Operadora: ".$simcard->operadora->nm_operadora." Tel: ".$simcard->nr_tel." ICC: ".$simcard->nr_icc;
        insertMovRastreador($rastreador, $ds_movimentacao);

        $simcard->st_simcard = "Desbloqueado";
        $simcard->save();
        $ds_movimentacao = "Simcard desvinculado do rastreador: <br>
        Cod: ".$rastreador->cod_rastreador."<br>
        Marca: ".$rastreador->marca->nm_marca."<br>
        Tipo: ".$rastreador->tipo->nm_tipo_rastreador."<br>
        Modelo: ".$rastreador->modelo->nm_modelo."<br>
        ";
        insertMovSimcard($simcard, $ds_movimentacao);

        return redirect()->route('oficina.rastreadores')->with('mensagem','Rastreador Desabilitado!');
    }

    public function rastreadores_estoque($id){
        $rastreador = Rastreador::where('id', $id)->first();
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('oficina/rastreadores_estoque', compact('rastreador','estoques'));
    }

    public function rastreadores_estoque_set(Request $request){
        $rastreador = Rastreador::where('id', $request->get('rastreador_id'))->first();
        $estoque = Estoque::where('id', $request->get('estoque_id'))->first();
        $rastreador->estoque_id = $estoque->id;
        $rastreador->save();

        $ds_movimentacao = "Rastreador trasnferido para o estoque ".$estoque->nm_estoque;
        insertMovRastreador($rastreador, $ds_movimentacao);

        return redirect()->route('oficina.rastreadores')->with('mensagem','Rastreador transferido de estoque!');
    }

    public function rastreadores_baixar($id){
        $rastreador = Rastreador::where('id', $id)->first();

        return view('oficina/rastreadores_baixar', compact('rastreador'));
    }

    public function rastreadores_baixar_set(Request $request){
        $rastreador = Rastreador::where('id', $request->get('rastreador_id'))->first();
        $rastreador->estoque_id = null;
        $rastreador->st_rastreador = 'Baixado';
        $rastreador->ds_motivo_baixa = $request->get('ds_motivo_baixa');
        $rastreador->save();

        $ds_movimentacao = "Rastreador baixado";
        insertMovRastreador($rastreador, $ds_movimentacao);

        return redirect()->route('oficina.rastreadores')->with('mensagem','Rastreador baixado!');
    }

    public function instalacoes(){
        $instalacoes = Instalacao::where('st_instalacao','<>','Desinstalado')->get();

        return view('oficina/instalacoes', compact('instalacoes'));
    }

    public function instalacoes_adicionar(){
        $clientes = Cliente::all()->sortBy('nm_cliente');
        $rastreadores = Rastreador::where('st_rastreador','Habilitado')->orderBy('cod_rastreador')->get();
        $produtos = Produto::all()->sortBy('nm_produto');
        $ferramentas = Ferramenta::where('estoque_id',"<>",'')->get();
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('oficina/instalacoes_adicionar', compact('clientes','rastreadores','produtos','estoques','ferramentas'));
    }

    public function instalacoes_insert(Request $request){
        $cliente = Cliente::where('id', $request->get('cliente_id'))->first();
        $veiculo = Veiculo::where('id', $request->get('veiculo_id'))->first();
        $rastreador = Rastreador::where('id', $request->get('rastreador_id'))->first();
        $simcard = Simcard::where('id', $rastreador->simcard_id)->first();

        $dados_instalacao = [
            'cliente_id' => $cliente->id,
            'veiculo_id' => $veiculo->id,
            'rastreador_id' => $rastreador->id,
            'simcard_id' => $simcard->id,
            'user_id' => Auth::id(),
            'dt_instalacao' => $request->get('dt_instalacao'),
            'st_instalacao' => 'Instalado',
            'ds_obs' => $request->get('ds_obs'),
        ];

        $instalacao = Instalacao::create($dados_instalacao);

        $rastreador->veiculo_id = $veiculo->id;
        $rastreador->estoque_id = null;
        $rastreador->st_rastreador = 'Instalado';
        $rastreador->save();

        $ds_movimentacao = "Rastreador instalado em veículo";
        insertMovRastreador($rastreador, $ds_movimentacao);

        $ds_movimentacao = "Simcard instalado em veículo";
        insertMovSimcard($simcard, $ds_movimentacao);

        for($i=1 ; $i<=$request->get('contador_ferramentas') ; $i++){
            $var = 'ferramenta_id'.$i;
            $ferramenta_id = $request->get($var);

            if($ferramenta_id){
                $ferramenta = Ferramenta::where('id', $ferramenta_id)->first();

                $dados_ferramenta = [
                    'instalacao_id' => $instalacao->id,
                    'ferramenta_id' => $ferramenta->id,
                    'estoque_id' => $ferramenta->estoque_id,
                ];

                InstalacaoFerramenta::create($dados_ferramenta);

                $ferramenta->estoque_id = null;
                $ferramenta->st_ferramenta = 'Vinculada Instalação';
                $ferramenta->save();

                $ds_movimentacao = "Ferramenta atrelada a instalação:<br>
                ID: ".$instalacao->id."<br>
                Cliente: ".$cliente->nm_cliente."<br>
                Veículo: ".$veiculo->marca->nm_marca." ".$veiculo->ds_modelo." Placa: ".$veiculo->nr_placa." Chassi: ".$veiculo->nr_chassi."<br>
                ";
                insertMovFerramenta($ferramenta, $ds_movimentacao);
            }
        }

        for($i=1 ; $i<=$request->get('contador_produtos') ; $i++){
            $var = 'produto_id'.$i;
            $produto_id = $request->get($var);
            $var = 'qt_produto'.$i;
            $qt_produto = $request->get($var);
            $var = 'estoque_id'.$i;
            $estoque_id = $request->get($var);

            if($produto_id && $qt_produto && $estoque_id){
                $dados_prod = [
                    'instalacao_id' => $instalacao->id,
                    'produto_id' => $produto_id,
                    'estoque_id' => $estoque_id,
                    'qt_produto' => $qt_produto,
                    'st_produto' => 'Instalado',
                ];

                InstalacaoProduto::create($dados_prod);
            }
        }

        return redirect()->route('oficina.instalacoes')->with('mensagem', "Rastreador Instalado!");
    }

    public function instalacoes_visualizar($id){
        $instalacao = Instalacao::where('id', $id)->first();
        $produtos = InstalacaoProduto::where('instalacao_id', $instalacao->id)->get();
        $ferramentas = InstalacaoFerramenta::where('instalacao_id', $instalacao->id)->get();

        return view('oficina/instalacoes_visualizar', compact('instalacao','produtos','ferramentas'));
    }

    public function instalacoes_desinstalar($id){
        $instalacao = Instalacao::where('id', $id)->first();
        $produtos = InstalacaoProduto::where('instalacao_id', $instalacao->id)->get();
        $estoques = Estoque::all()->sortBy('nm_estoque');
        $ferramentas = InstalacaoFerramenta::where('instalacao_id', $instalacao->id)->get();

        return view('oficina/instalacoes_desinstalar', compact('instalacao','produtos','estoques','ferramentas'));
    }

    public function instalacoes_desinstalar_set(Request $request){
        $instalacao = Instalacao::where('id', $request->get('instalacao_id'))->first();

        $rastreador = Rastreador::where('id', $instalacao->rastreador_id)->first();
        $simcard = Simcard::where('id', $instalacao->simcard_id)->first();

        $instalacao->st_instalacao = 'Desinstalado';
        $instalacao->dt_desinstalacao = $request->get('dt_desinstalacao');
        $instalacao->ds_obs_desinstalacao = $request->get('ds_obs_desinstalacao');
        $instalacao->save();

        $rastreador->veiculo_id = null;
        $rastreador->estoque_id = $request->get('estoque_id');
        $rastreador->st_rastreador = 'Habilitado';
        $rastreador->save();

        $ds_movimentacao = "Rastreador desinstalado do veiculo.";
        insertMovRastreador($rastreador, $ds_movimentacao);

        $ds_movimentacao = "Simcard desinstalado do veiculo.";
        insertMovSimcard($simcard, $ds_movimentacao);

        //vamos verificar se alguma ferramenta é retornado para o estoque
        $ferramentas = InstalacaoFerramenta::where('instalacao_id', $instalacao->id)->get();
        foreach($ferramentas as $linha){
            $ferramenta = Ferramenta::where('id', $linha->ferramenta->id)->first();
            $ferramenta->estoque_id = $linha->estoque_id;
            $ferramenta->st_ferramenta = 'Habilitada';
            $ferramenta->save();

            $ds_movimentacao = "Patrimônio/Ferramenta desvinculada da intalação.";

            insertMovFerramenta($ferramenta, $ds_movimentacao);
        }


        //vamos verificar se algum produto é retornado para o estoque
        $produtos = InstalacaoProduto::where('instalacao_id', $instalacao->id)->get();

        foreach($produtos as $produto){
            $var = "st_produto".$produto->id;
            $st_produto = $request->get($var);

            if($st_produto == "Retorno Estoque"){
                $produto->st_produto = 'Retorno Estoque';
                $produto->save();
            }
        }

        return redirect()->route('oficina.instalacoes')->with('mensagem','Rastreador Desinstalado!');
    }

}
