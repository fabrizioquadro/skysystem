<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simcard;
use App\Models\Operadora;
use App\Models\Movimentacaosimcard;

class SimCardController extends Controller
{
    public function index(){
        $sims = Simcard::all();

        return view('simcards/index', compact('sims'));
    }

    public function adicionar(){
        $operadoras = Operadora::all()->sortBy('nm_operadora');

        return view('simcards/adicionar', compact('operadoras'));
    }

    public function insert(Request $request){
        for($i=1 ; $i<=$request->get('contador_simcard') ; $i++){
            $var = "operadora_id".$i;
            $operadora_id = $request->get($var);
            $var = "nr_tel".$i;
            $nr_tel = $request->get($var);
            $var = "nr_icc".$i;
            $nr_icc = $request->get($var);

            if($operadora_id && $nr_tel && $nr_icc){
                $dados = [
                    'operadora_id' => $operadora_id,
                    'nr_tel' => $nr_tel,
                    'nr_icc' => $nr_icc,
                    'st_simcard' => 'Bloqueado',
                ];

                $simcard = Simcard::create($dados);
                $ds_movimentacao = "Simcard registrado no sistema.";
                insertMovSimcard($simcard, $ds_movimentacao);
            }
        }

        return redirect()->route('simcards')->with('mensagem', 'SimCard(s) cadastrado(s)!');
    }

    public function editar($id){
        $sim = Simcard::where('id', $id)->first();
        $operadoras = Operadora::all()->sortBy('nm_operadora');

        return view('simcards/editar', compact('sim','operadoras'));
    }

    public function update(Request $request){
        $id = $request->get('simcard_id');
        $dados = $request->except('simcard_id','_token');

        Simcard::where('id', $id)->update($dados);

        $simcard = Simcard::where('id', $id)->first();
        $ds_movimentacao = "Simcard editado.";
        insertMovSimcard($simcard, $ds_movimentacao);

        return redirect()->route('simcards')->with('mensagem', 'SimCard editado!');
    }

    public function excluir($id){
        $sim = Simcard::where('id', $id)->first();

        return view('simcards/excluir', compact('sim'));
    }

    public function delete(Request $request){
        $id = $request->get('simcard_id');

        Movimentacaosimcard::where('simcard_id', $id)->delete();
        Simcard::where('id', $id)->delete();

        return redirect()->route('simcards')->with('mensagem', 'SimCard excluído!');
    }

}
