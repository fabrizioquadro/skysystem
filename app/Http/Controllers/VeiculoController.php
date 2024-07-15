<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Cliente;
use App\Models\Marca;

class VeiculoController extends Controller
{
    public function index(){
        $veiculos = Veiculo::all();

        return view('veiculos/index', compact('veiculos'));
    }

    public function adicionar(){
        $clientes = Cliente::all()->sortBy('nm_cliente');
        $marcas = Marca::getMarcaVeiculos();

        return view('veiculos/adicionar', compact('clientes','marcas'));
    }

    public function insert(Request $request){
        $dados = $request->all();
        $dados['st_veiculo'] = 'Liberado';

        Veiculo::create($dados);

        return redirect()->route('veiculos')->with('mensagem','Veículo cadastrado!');
    }

    public function editar($id){
        $clientes = Cliente::all()->sortBy('nm_cliente');
        $marcas = Marca::getMarcaVeiculos();
        $veiculo = Veiculo::where('id', $id)->first();

        return view('veiculos/editar', compact('clientes','veiculo','marcas'));
    }

    public function update(Request $request){
        $id = $request->get('veiculo_id');
        $dados = $request->except('veiculo_id','_token');

        Veiculo::where('id', $id)->update($dados);

        return redirect()->route('veiculos')->with('mensagem','Veículo editado!');
    }

    public function excluir($id){
        $veiculo = Veiculo::where('id', $id)->first();

        return view('veiculos/excluir', compact('veiculo'));
    }

    public function delete(Request $request){
        $id = $request->get('veiculo_id');

        Veiculo::where('id', $id)->delete();

        return redirect()->route('veiculos')->with('mensagem','Veículo excluído!');
    }

    public function busca_veiculos_cliente(){
        $cliente_id = $_GET['cliente_id'];

        $veiculos = Veiculo::where('cliente_id', $cliente_id)->get();
        $html = "
            <label>Veículo:</label>
            <select class='form-control combobox_veiculo' name='veiculo_id'>
                <option></option>";
        foreach($veiculos as $veiculo){
            $html .= "<option value='$veiculo->id'>".$veiculo->marca->nm_marca." $veiculo->ds_modelo $veiculo->nr_placa, Chassi: $veiculo->nr_chassi</option>";
        }

        $html .= "</select>";

        $retorno['html'] = $html;
        return json_encode($retorno);
    }

    public function instalacoes($id){
        $veiculo = Veiculo::where('id', $id)->first();

        return view('veiculos/instalacoes', compact('veiculo'));
    }
}
