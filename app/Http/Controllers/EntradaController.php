<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Entradaproduto;
use App\Models\Produto;
use App\Models\Estoque;


class EntradaController extends Controller
{
    public function index(){
        $entradas = Entrada::all();

        return view('entradas/index', compact('entradas'));
    }

    public function adicionar(){
        $produtos = Produto::all()->sortBy('nm_produto');
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('entradas/adicionar', compact('produtos','estoques'));
    }

    public function insert(Request $request){
        //vamos gerar a entrada
        $dados_entrada = [
            'dt_entrada' => $request->get('dt_entrada'),
            'nm_fornecedor' => $request->get('nm_fornecedor'),
            'nr_notafiscal' => $request->get('nr_notafiscal'),
        ];

        $entrada = Entrada::create($dados_entrada);

        for($i=1 ; $i<=$request->get('contador_produtos') ; $i++){
            $var = "produto_id".$i;
            $produto_id = $request->get($var);
            $var = "qt_produto".$i;
            $qt_produto = $request->get($var);
            $var = "vl_produto".$i;
            $vl_produto = $request->get($var);
            $var = "estoque_id".$i;
            $estoque_id = $request->get($var);

            if($produto_id && $qt_produto && $estoque_id && $vl_produto){
                $dados_prod = [
                    'entrada_id' =>$entrada->id,
                    'produto_id' =>$produto_id,
                    'estoque_id' =>$estoque_id,
                    'qt_produto' =>$qt_produto,
                    'vl_produto' =>valorFormDb($vl_produto),
                ];

                Entradaproduto::create($dados_prod);
            }
        }

        return redirect()->route('entradas')->with('mensagem', "Entrada cadastrada!");
    }

    public function editar($id){
        $entrada = Entrada::where('id', $id)->first();
        $produtos_cad = Entradaproduto::where('entrada_id', $entrada->id)->orderBy('id')->get();
        $produtos = Produto::all()->sortBy('nm_produto');
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('entradas/editar', compact('entrada','produtos','produtos_cad','estoques'));
    }

    public function delete_prod(){
        $id = $_GET['id'];

        Entradaproduto::where('id', $id)->delete();

        $retorno['controle'] = "true";

        echo json_encode($retorno);
    }

    public function update(Request $request){
        $entrada = Entrada::where('id', $request->get('entrada_id'))->first();

        $entrada->nm_fornecedor = $request->get('nm_fornecedor');
        $entrada->nr_notafiscal = $request->get('nr_notafiscal');
        $entrada->dt_entrada = $request->get('dt_entrada');

        $entrada->save();

        for($i=1 ; $i<=$request->get('contador_produtos') ; $i++){
            $var = "produto_id".$i;
            $produto_id = $request->get($var);
            $var = "qt_produto".$i;
            $qt_produto = $request->get($var);
            $var = "vl_produto".$i;
            $vl_produto = $request->get($var);
            $var = "estoque_id".$i;
            $estoque_id = $request->get($var);

            if($produto_id && $qt_produto && $vl_produto && $estoque_id){
                $dados_prod = [
                    'entrada_id' =>$entrada->id,
                    'produto_id' =>$produto_id,
                    'estoque_id' =>$estoque_id,
                    'qt_produto' =>$qt_produto,
                    'vl_produto' =>valorFormDb($vl_produto),
                ];

                Entradaproduto::create($dados_prod);
            }
        }

        return redirect()->route('entradas')->with('mensagem', "Entrada Editada!");
    }

    public function excluir($id){
        $entrada = Entrada::where('id', $id)->first();

        return view('entradas/excluir', compact('entrada'));
    }

    public function delete(Request $request){
        $id = $request->get('entrada_id');

        Entradaproduto::where('entrada_id', $id)->delete();
        Entrada::where('id', $id)->delete();

        return redirect()->route('entradas')->with('mensagem','Entrada excluída!');
    }

    public function visualizar($id){
        $entrada = Entrada::where('id', $id)->first();
        $produtos = Entradaproduto::where('entrada_id', $entrada->id)->orderBy('id')->get();

        return view('entradas/visualizar', compact('entrada','produtos'));
    }
}
