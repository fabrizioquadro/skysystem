<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ferramenta;
use App\Models\Marca;
use App\Models\Estoque;
use App\Models\Movimentacaoferramenta;

class FerramentaController extends Controller
{
    public function index(){
        $ferramentas = Ferramenta::all();

        return view('ferramentas/index', compact('ferramentas'));
    }

    public function adicionar(){
        $marcas = Marca::getMarcaProdutosFerramentas();
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('ferramentas/adicionar', compact('marcas','estoques'));
    }

    public function insert(Request $request){
        $dados = $request->all();
        if(!$dados['estoque_id']){
            $estoque = Estoque::getEstoqueAdm();
            if($estoque){
                $dados['estoque_id'] = $estoque->id;
            }
        }
        $dados['st_ferramenta'] = 'Habilitada';
        $dados['vl_ferramenta'] = valorFormDb($dados['vl_ferramenta']);

        $ferramenta = Ferramenta::create($dados);
        $estoque = Estoque::where('id', $ferramenta->estoque_id)->first();
        $ds_movimentacao = "Patrimônio/Ferramenta inserida no sistema atrelada ao estoque '$estoque->nm_estoque'.";
        insertMovFerramenta($ferramenta, $ds_movimentacao);

        return redirect()->route('ferramentas')->with('mensagem','Patrimônio/Ferramenta cadastrada!');
    }

    public function editar($id){
        $marcas = Marca::getMarcaProdutosFerramentas();
        $estoques = Estoque::all()->sortBy('nm_estoque');
        $ferramenta = Ferramenta::where('id', $id)->first();

        return view('ferramentas/editar', compact('marcas','ferramenta','estoques'));
    }

    public function update(Request $request){
        $id = $request->get('ferramenta_id');
        $dados = $request->except('_token','ferramenta_id');

        if(!$dados['estoque_id']){
            $estoque = Estoque::getEstoqueAdm();
            if($estoque){
                $dados['estoque_id'] = $estoque->id;
            }
        }
        $dados['vl_ferramenta'] = valorFormDb($dados['vl_ferramenta']);

        Ferramenta::where('id', $id)->update($dados);
        $ferramenta = Ferramenta::where('id', $id)->first();
        $ds_movimentacao = "Patrimônio/Ferramenta editada no sistema.";
        insertMovFerramenta($ferramenta, $ds_movimentacao);

        return redirect()->route('ferramentas')->with('mensagem','Patrimônio/Ferramenta editada!');
    }

    public function excluir($id){
        $ferramenta = Ferramenta::where('id', $id)->first();

        return view('ferramentas/excluir', compact('ferramenta'));
    }

    public function delete(Request $request){
        $id = $request->get('ferramenta_id');

        Movimentacaoferramenta::where('ferramenta_id', $id)->delete();
        Ferramenta::where('id', $id)->delete();

        return redirect()->route('ferramentas')->with('mensagem','Patrimônio/Ferramenta excluída!');
    }

    public function alterar_estoque($id){
        $ferramenta = Ferramenta::where('id', $id)->first();
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('ferramentas/alterar_estoque', compact('ferramenta','estoques'));
    }

    public function alterar_estoque_update(Request $request){
        //vamos alterar o estoque da ferramenta
        $ferramenta = Ferramenta::where('id', $request->get('ferramenta_id'))->first();

        $ferramenta->estoque_id = $request->get('estoque_id');
        $ferramenta->save();

        $ds_movimentacao = "Patrimônio/Ferramenta transferida para o estoque ".$ferramenta->estoque->nm_estoque.".";
        insertMovFerramenta($ferramenta, $ds_movimentacao);

        return redirect()->route('ferramentas')->with('mensagem','Alterado estoque do patrimônio/ferramenta.');
    }

    public function enviar_manutencao($id){
        $estoques = Estoque::all()->sortBy('nm_estoque');
        $ferramenta = Ferramenta::where('id', $id)->first();

        return view('ferramentas/enviar_manutencao', compact('ferramenta','estoques'));
    }

    public function enviar_manutencao_set(Request $request){
        $ferramenta = Ferramenta::where('id', $request->get('ferramenta_id'))->first();
        if($request->get('estoque_id')){
            $estoque_id = $request->get('estoque_id');
        }
        else{
            $estoque_id = null;
        }
        $ferramenta->estoque_id = $estoque_id;
        $ferramenta->st_ferramenta = 'Manutenção';
        $ferramenta->save();

        $ds_movimentacao = "Patrimônio/Ferramenta transferida para manutenção.<br>Motivo: ".$request->get('ds_motivo');
        insertMovFerramenta($ferramenta, $ds_movimentacao);

        return redirect()->route('ferramentas')->with('mensagem','Patrimônio/Ferramenta enviada para manutenção.');
    }

    public function retorno_manutencao($id){
        $ferramenta = Ferramenta::where('id', $id)->first();
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('ferramentas/retorno_manutencao', compact('ferramenta','estoques'));
    }

    public function retorno_manutencao_set(Request $request){
        //vamos setar a ferramenta no estoque indicado
        $ferramenta = Ferramenta::where('id', $request->get('ferramenta_id'))->first();
        $ferramenta->estoque_id = $request->get('estoque_id');
        $ferramenta->st_ferramenta = 'Habilitada';
        $ferramenta->save();

        $ds_movimentacao = "Patrimônio/Ferramenta retornada de manutenção e alocada no estoque ".$ferramenta->estoque->nm_estoque;
        if($request->get('vl_reparo')){
            $ds_movimentacao .= "<br>Valor do Reparo: R$".$request->get('vl_reparo');
        }
        insertMovFerramenta($ferramenta, $ds_movimentacao, $request->get('vl_reparo'));

        return redirect()->route('ferramentas')->with('mensagem','Patrimônio/Ferramenta retornada de manutenção.');
    }

    public function baixar($id){
        $ferramenta = Ferramenta::where('id', $id)->first();

        return view('ferramentas/baixar', compact('ferramenta'));
    }

    public function baixar_set(Request $request){
        $ferramenta = Ferramenta::where('id', $request->get('ferramenta_id'))->first();
        $ferramenta->st_ferramenta = 'Baixada';
        $ferramenta->estoque_id = null;
        $ferramenta->ds_motivo_baixa = $request->get('ds_motivo');
        $ferramenta->save();

        $ds_movimentacao = "Patrimônio/Ferramenta Baixada.<br>Motivo: ".$request->get('ds_motivo');
        insertMovFerramenta($ferramenta, $ds_movimentacao);

        return redirect()->route('ferramentas')->with('mensagem','Patrimônio/Ferramenta baixada!');
    }

}
