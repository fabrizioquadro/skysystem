<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function index(){
        $marcas = Marca::all();

        return view('marcas/index', compact('marcas'));
    }

    public function adicionar(){
        return view('marcas/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->only('nm_marca','tp_marca');

        Marca::create($dados);

        return redirect()->route('marcas')->with('mensagem','Marca cadastrada!');
    }

    public function editar($id){
        $marca = Marca::where('id', $id)->first();

        return view('marcas/editar', compact('marca'));
    }

    public function update(Request $request){
        $id = $request->get('marca_id');
        $dados = $request->only('nm_marca','tp_marca');

        Marca::where('id', $id)->update($dados);

        return redirect()->route('marcas')->with('mensagem','Marca editada!');
    }

    public function excluir($id){
        $marca = Marca::where('id', $id)->first();

        return view('marcas/excluir', compact('marca'));
    }

    public function delete(Request $request){
        $id = $request->get('marca_id');

        Marca::where('id', $id)->delete();

        return redirect()->route('marcas')->with('mensagem','Marca excluída!');
    }

}
