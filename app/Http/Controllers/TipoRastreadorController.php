<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiporastreador;

class TipoRastreadorController extends Controller
{
    public function index(){
        $tipos = Tiporastreador::all();

        return view('tipos_rastreadores/index', compact('tipos'));
    }

    public function adicionar(){
        return view('tipos_rastreadores/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->all();
        Tiporastreador::create($dados);

        return redirect()->route('tipos_rastreadores')->with('mensagem','Tipo de rastreador cadastrado!');
    }

    public function editar($id){
        $tipo = Tiporastreador::where('id', $id)->first();

        return view('tipos_rastreadores/editar', compact('tipo'));
    }

    public function update(Request $request){
        $id = $request->get('tipo_id');

        $dados = $request->except('_token','tipo_id');
        Tiporastreador::where('id', $id)->update($dados);

        return redirect()->route('tipos_rastreadores')->with('mensagem','Tipo de rastreador editado!');
    }

    public function excluir($id){
        $tipo = Tiporastreador::where('id', $id)->first();

        return view('tipos_rastreadores/excluir', compact('tipo'));
    }

    public function delete(Request $request){
        $id = $request->get('tipo_id');

        Tiporastreador::where('id', $id)->delete();

        return redirect()->route('tipos_rastreadores')->with('mensagem','Tipo de rastreador excluído!');
    }

}
