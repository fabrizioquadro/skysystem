<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baixa;
use App\Models\BaixaProduto;
use App\Models\Estoque;
use App\Models\Produto;

class BaixaController extends Controller
{
    public function index(){
        $baixas = Baixa::all();

        return view('baixas/index', compact('baixas'));
    }

    public function adicionar(){
        $produtos = Produto::all()->sortBy('nm_produto');
        $estoques = Estoque::all()->sortBy('nm_produto');

        return view('baixas/adicionar', compact('produtos','estoques'));
    }

    public function insert(Request $request){
        $dados_baixa = [
            'dt_baixa' => $request->get('dt_baixa'),
            'ds_motivo' => $request->get('ds_motivo'),
        ];

        $baixa = Baixa::create($dados_baixa);

        for($i=1 ; $i<=$request->get('contador_produtos') ; $i++){
            $var = "produto_id".$i;
            $produto_id = $request->get($var);
            $var = "estoque_id".$i;
            $estoque_id = $request->get($var);
            $var = "qt_produto".$i;
            $qt_produto = $request->get($var);

            if($produto_id && $estoque_id && $qt_produto){
                $dados = [
                    'baixa_id' => $baixa->id,
                    'produto_id' => $produto_id,
                    'estoque_id' => $estoque_id,
                    'qt_produto' => $qt_produto,
                ];

                BaixaProduto::create($dados);
            }
        }

        return redirect()->route('baixas')->with('mensagem','Baixa cadastrada!');
    }

    public function editar($id){
        $baixa = Baixa::where('id', $id)->first();
        $produtos_cad = BaixaProduto::where('baixa_id', $baixa->id)->get();
        $produtos = Produto::all()->sortBy('nm_produto');
        $estoques = Estoque::all()->sortBy('nm_produto');

        return view('baixas/editar', compact('baixa','produtos_cad','estoques','produtos'));
    }

    public function delete_prod(){
        $id = $_GET['id'];

        BaixaProduto::where('id', $id)->delete();

        $retorno['controle'] = 'true';
        echo json_encode($retorno);
    }

    public function update(Request $request){
        $baixa = Baixa::where('id', $request->get('baixa_id'))->first();
        $baixa->dt_baixa = $request->get('dt_baixa');
        $baixa->ds_motivo = $request->get('ds_motivo');

        $baixa->save();

        for($i=1 ; $i<=$request->get('contador_produtos') ; $i++){
            $var = "produto_id".$i;
            $produto_id = $request->get($var);
            $var = "estoque_id".$i;
            $estoque_id = $request->get($var);
            $var = "qt_produto".$i;
            $qt_produto = $request->get($var);

            if($produto_id && $estoque_id && $qt_produto){
                $dados = [
                    'baixa_id' => $baixa->id,
                    'produto_id' => $produto_id,
                    'estoque_id' => $estoque_id,
                    'qt_produto' => $qt_produto,
                ];

                BaixaProduto::create($dados);
            }
        }

        return redirect()->route('baixas')->with('mensagem','Baixa editada!');
    }

    public function excluir($id){
        $baixa = Baixa::where('id', $id)->first();

        return view('baixas/excluir', compact('baixa'));
    }

    public function delete(Request $request){
        BaixaProduto::where('baixa_id', $request->get('baixa_id'))->delete();
        Baixa::where('id', $request->get('baixa_id'))->delete();

        return redirect()->route('baixas')->with('mensagem','Baixa excluída!');
    }

    public function visualizar($id){
        $baixa = Baixa::where('id', $id)->first();
        $produtos_cad = BaixaProduto::where('baixa_id', $baixa->id)->get();

        return view('baixas/visualizar', compact('baixa','produtos_cad'));
    }


}
