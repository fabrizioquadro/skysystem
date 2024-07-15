<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueController extends Controller
{
    public function index(){
        $estoques = Estoque::all();

        return view('estoques/index', compact('estoques'));
    }

    public function adicionar(){
        return view('estoques/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();
        $dados['st_estoque_adm'] = 'Não';

        Estoque::create($dados);

        return redirect()->route('estoques')->with('mensagem','Estoque cadastrado!');
    }

    public function editar($id){
        $estoque = Estoque::where('id', $id)->first();

        return view('estoques/editar', compact('estoque'));
    }

    public function update(Request $request){
        $id = $request->get('estoque_id');
        $dados = $request->except('estoque_id','_token');

        Estoque::where('id', $id)->update($dados);

        return redirect()->route('estoques')->with('mensagem','Estoque editado!');
    }

    public function excluir($id){
        $estoque = Estoque::where('id', $id)->first();

        return view('estoques/excluir', compact('estoque'));
    }

    public function delete(Request $request){
        $id = $request->get('estoque_id');

        Estoque::where('id', $id)->delete();

        return redirect()->route('estoques')->with('mensagem','Estoque excluído!');
    }

    public function estoque_adm(){
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('estoques/estoque_adm', compact('estoques'));
    }

    public function estoque_adm_set(Request $request){
        //vamos setar todos os estques como não
        Estoque::setEstoquesNao();

        $dados_update = [
            'st_estoque_adm' => 'Sim',
        ];
        $id = $request->get('estoque_id');
        Estoque::where('id', $id)->update($dados_update);

        return redirect()->route('estoques')->with('mensagem','Estoque administrativo setado!');
    }

    public function confere_quant_disponivel(){
        $produto_id = $_GET['produto_id'];
        $estoque_id = $_GET['estoque_id'];
        $qt_produto = $_GET['qt_produto'];

        //vamos verificar todas as entradas desse produto no estoque
        $qt_prod_estoque = Estoque::getEstoqueProduto($estoque_id, $produto_id);
        $controle = 'true';
        if($qt_produto > $qt_prod_estoque){
            $controle = 'false';
        }
        $retorno['controle'] = $controle;
        echo json_encode($retorno);
    }

}
