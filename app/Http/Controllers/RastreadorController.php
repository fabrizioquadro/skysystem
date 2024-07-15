<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rastreador;
use App\Models\Marca;
use App\Models\Tiporastreador;
use App\Models\Modelorastreador;
use App\Models\Movimentacaorastreador;
use App\Models\Estoque;

class RastreadorController extends Controller
{
    public function index(){
        $rastreadores = Rastreador::all();

        return view('rastreadores/index', compact('rastreadores'));
    }

    public function adicionar(){
        $marcas = Marca::getMarcaRastreadores();
        return view('rastreadores/adicionar', compact('marcas'));
    }

    public function insert(Request $request){
        $estoque = Estoque::getEstoqueAdm();

        for($i=1 ; $i<=$request->get('contador_rastreadores') ; $i++){
            $var = "cod_rastreador".$i;
            $cod_rastreador = $request->get($var);
            $var = "marca_id".$i;
            $marca_id = $request->get($var);
            $var = "tiporastreador_id".$i;
            $tiporastreador_id = $request->get($var);
            $var = "modelorastreador_id".$i;
            $modelorastreador_id = $request->get($var);

            if($cod_rastreador && $marca_id && $tiporastreador_id && $modelorastreador_id){
                $dados = [
                    'cod_rastreador' => $cod_rastreador,
                    'marca_id' => $marca_id,
                    'tiporastreador_id' => $tiporastreador_id,
                    'modelorastreador_id' => $modelorastreador_id,
                    'st_rastreador' => 'Bloqueado',
                    'estoque_id' => $estoque->id,
                ];

                $rastreador = Rastreador::create($dados);
                $ds_movimentacao = "Rastreador registrado no sistema.";
                insertMovRastreador($rastreador, $ds_movimentacao);
            }
        }

        return redirect()->route('rastreadores')->with('mensagem','Rastreador(s) cadastrado(s)!');
    }

    public function editar($id){
        $rastreador = Rastreador::where('id', $id)->first();
        $marcas = Marca::getMarcaRastreadores();
        $tipos = Tiporastreador::all()->sortBy('nm_tipo_rastreador');
        $modelos = Modelorastreador::all()->sortBy('nm_modelo');

        return view('rastreadores/editar', compact('rastreador','marcas','tipos','modelos'));
    }

    public function update(Request $request){
        $id = $request->get('rastreador_id');
        $dados = $request->except('rastreador_id', '_token');

        Rastreador::where('id', $id)->update($dados);
        $rastreador = Rastreador::where('id', $id)->first();
        $ds_movimentacao = "Rastreador editado.";
        insertMovRastreador($rastreador, $ds_movimentacao);

        return redirect()->route('rastreadores')->with('mensagem','Rastreador editado!');
    }

    public function excluir($id){
        $rastreador = Rastreador::where('id', $id)->first();

        return view('rastreadores/excluir', compact('rastreador'));
    }

    public function delete(Request $request){
        $id = $request->get('rastreador_id');

        Movimentacaorastreador::where('rastreador_id', $id)->delete();
        Rastreador::where('id', $id)->delete();

        return redirect()->route('rastreadores')->with('mensagem','Rastreador excluído!');
    }

    public function busca_tipo(){
        $marca_id = $_GET['marca_id'];
        $linha = $_GET['linha'];

        $tipos = Tiporastreador::busca_tipos_marca($marca_id);
        $html = "
            <select name='tiporastreador_id".$linha."' onchange='getModelosRastreadores(this.value, ".$linha.")' class='form-control combobox_tipo".$linha."'>
            <option></option>
        ";
        foreach($tipos as $tipo){
            $html .= "<option value='$tipo->id'>$tipo->nm_tipo_rastreador</option>";
        }

        $html .= "</select>";

        $retorno['html'] = $html;

        $html = "
            <select name='modelorastreador_id".$linha."' class='form-control combobox_tipo".$linha."'>
                <option></option>
            </select>
        ";

        $retorno['html_modelos'] = $html;

        echo json_encode($retorno);
    }

    public function busca_modelo(){
        $marca_id = $_GET['marca_id'];
        $tiporastreador_id = $_GET['tiporastreador_id'];
        $linha = $_GET['linha'];

        $dados_pesq = [
            'marca_id' => $marca_id,
            'tiporastreador_id' => $tiporastreador_id,
        ];

        $modelos = Modelorastreador::where($dados_pesq)->get();
        $html = "
        <select name='modelorastreador_id".$linha."' class='form-control combobox_modelo".$linha."'>
        <option></option>";
        foreach($modelos as $modelo){
            $html .= "<option value='$modelo->id'>$modelo->nm_modelo</option>";
        }
        $html .= "</select>";

        $retorno['html'] = $html;
        echo json_encode($retorno);
    }

}
