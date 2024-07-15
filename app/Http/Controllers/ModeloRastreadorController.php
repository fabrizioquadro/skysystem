<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelorastreador;
use App\Models\Marca;
use App\Models\Tiporastreador;

class ModeloRastreadorController extends Controller
{
    public function index(){
        $modelos = Modelorastreador::all();

        return view('modelos_rastreadores/index', compact('modelos'));
    }

    public function adicionar(){
        $marcas = Marca::getMarcaRastreadores();
        $tipos = Tiporastreador::all()->sortBy('nm_tipo_rastreador');

        return view('modelos_rastreadores/adicionar', compact('marcas','tipos'));
    }

    public function insert(Request $request){
        $dados = $request->all();

        Modelorastreador::create($dados);

        return redirect()->route('modelos_rastreadores')->with('mensagem','Modelo de rastreador cadastrado!');
    }

    public function editar($id){
        $modelo = Modelorastreador::where('id', $id)->first();

        $marcas = Marca::getMarcaRastreadores();
        $tipos = Tiporastreador::all()->sortBy('nm_tipo_rastreador');

        return view('modelos_rastreadores/editar', compact('modelo','marcas','tipos'));
    }

    public function update(Request $request){
        $id = $request ->get('modelo_id');
        $dados = $request->except('modelo_id','_token');

        Modelorastreador::where('id', $id)->update($dados);

        return redirect()->route('modelos_rastreadores')->with('mensagem','Modelo de rastreador editado!');
    }

    public function excluir($id){
        $modelo = Modelorastreador::where('id', $id)->first();

        return view('modelos_rastreadores/excluir', compact('modelo'));
    }

    public function delete(Request $request){
        $id = $request ->get('modelo_id');
        Modelorastreador::where('id', $id)->delete();

        return redirect()->route('modelos_rastreadores')->with('mensagem','Modelo de rastreador excluído!');
    }

}
