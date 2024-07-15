<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operadora;

class OperadoraController extends Controller
{
    public function index(){
        $operadoras = Operadora::all();

        return view('operadoras/index', compact('operadoras'));
    }

    public function adicionar(){
        return view('operadoras/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();

        Operadora::create($dados);

        return redirect()->route('operadoras')->with('mensagem','Operadora cadastrada!');
    }

    public function editar($id){
        $operadora = Operadora::where('id', $id)->first();

        return view('operadoras/editar', compact('operadora'));
    }

    public function update(Request $request){
        $id = $request->get('operadora_id');
        $dados = $request->except('operadora_id','_token');

        Operadora::where('id', $id)->update($dados);

        return redirect()->route('operadoras')->with('mensagem','Operadora editada!');
    }

    public function excluir($id){
        $operadora = Operadora::where('id', $id)->first();

        return view('operadoras/excluir', compact('operadora'));
    }

    public function delete(Request $request){
        $id = $request->get('operadora_id');

        Operadora::where('id', $id)->delete();

        return redirect()->route('operadoras')->with('mensagem','Operadora excluída!');
    }

}
