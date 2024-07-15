<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstoqueTransferencia;
use App\Models\Produto;
use App\Models\Estoque;

class TransferenciaEstoqueController extends Controller
{
    public function index(){
        $transferencias = EstoqueTransferencia::all()->sortBy('dt_transferencia');

        return view('transferencias_estoque/index', compact('transferencias'));
    }

    public function adicionar(){
        $produtos = Produto::all()->sortBy('nm_produto');
        $estoques = Estoque::all()->sortBy('nm_estoque');

        return view('transferencias_estoque/adicionar', compact('produtos','estoques'));
    }

    public function insert(Request $request){
        $dados = $request->all();

        EstoqueTransferencia::create($dados);
        return redirect()->route('transferencias')->with('mensagem','Transferência cadastrada!');
    }

    public function excluir($id){
        $transferencia = EstoqueTransferencia::where('id', $id)->first();

        return view('transferencias_estoque/excluir', compact('transferencia'));
    }

    public function delete(Request $request){
        EstoqueTransferencia::where('id', $request->get('id'))->delete();

        return redirect()->route('transferencias')->with('mensagem','Transferência excluída!');
    }
}
