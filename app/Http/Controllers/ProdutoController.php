<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Marca;

class ProdutoController extends Controller
{
    public function index(){
        $produtos = Produto::all();

        return view('produtos/index', compact('produtos'));
    }

    public function adicionar(){
        $marcas = Marca::getMarcaProdutosFerramentas();

        return view('produtos/adicionar', compact('marcas'));
    }

    public function insert(Request $request){
        $dados = $request->all();

        Produto::create($dados);

        return redirect()->route('produtos')->with('mensagem', 'Produto cadastrado!');
    }

    public function editar($id){
        $marcas = Marca::getMarcaProdutosFerramentas();
        $produto = Produto::where('id', $id)->first();

        return view('produtos/editar', compact('marcas','produto'));
    }

    public function update(Request $request){
        $id = $request->get('produto_id');

        $dados = $request->only('nm_produto','ds_produto','qt_minima','marca_id','ds_unidade','ds_obs');

        Produto::where('id', $id)->update($dados);

        return redirect()->route('produtos')->with('mensagem', 'Produto editado!');
    }

    public function excluir($id){
        $produto = Produto::where('id', $id)->first();

        return view('produtos/excluir', compact('produto'));
    }

    public function delete(Request $request){
        $id = $request->get('produto_id');
        Produto::where('id', $id)->delete();

        return redirect()->route('produtos')->with('mensagem', 'Produto excluído!');
    }

}
