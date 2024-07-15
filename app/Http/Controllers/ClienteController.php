<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(){
        $clientes = Cliente::all();

        return view('clientes/index', compact('clientes'));
    }

    public function adicionar(){
        return view('clientes/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();

        Cliente::create($dados);

        return redirect()->route('clientes')->with('mensagem','Cliente Cadastrado');
    }

    public function editar($id){
        $cliente = Cliente::where('id', $id)->first();

        return view('clientes/editar', compact('cliente'));
    }

    public function update(Request $request){
        $id = $request->get('cliente_id');
        $dados = $request->except('cliente_id','_token');

        Cliente::where('id', $id)->update($dados);

        return redirect()->route('clientes')->with('mensagem','Cliente editado!');
    }

    public function excluir($id){
        $cliente = Cliente::where('id', $id)->first();

        return view('clientes/excluir', compact('cliente'));
    }

    public function delete(Request $request){
        $id = $request->get('cliente_id');

        Cliente::where('id', $id)->delete();

        return redirect()->route('clientes')->with('mensagem','Cliente excluído!');
    }

    public function visualizar($id){
        $cliente = Cliente::where('id', $id)->first();

        return view('clientes/visualizar', compact('cliente'));
    }

}
