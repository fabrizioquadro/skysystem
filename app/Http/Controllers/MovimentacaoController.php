<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ferramenta;
use App\Models\Simcard;
use App\Models\Rastreador;
use App\Models\Movimentacaoferramenta;
use App\Models\Movimentacaosimcard;
use App\Models\Movimentacaorastreador;

class MovimentacaoController extends Controller
{
    public function ferramentas(){
        $ferramentas = Ferramenta::all()->sortBy('nm_ferramenta');

        return view('movimentacoes/ferramentas', compact('ferramentas'));
    }

    public function ferramentas_gerar(Request $request){
        $ferramenta = Ferramenta::where('id', $request->get('ferramenta_id'))->first();
        $movs = Movimentacaoferramenta::pesq_movimentacao($request->get('ferramenta_id'), $request->get('dt_inc'), $request->get('dt_fn'));

        return view('movimentacoes/ferramenta_pesq', compact('ferramenta','movs'));
    }

    public function simcards(){
        $simcards = Simcard::all()->sortBy('id');

        return view('movimentacoes/simcards', compact('simcards'));
    }

    public function simcards_gerar(Request $request){
        $simcard = Simcard::where('id', $request->get('simcard_id'))->first();
        $movs = Movimentacaosimcard::pesq_movimentacao($request->get('simcard_id'), $request->get('dt_inc'), $request->get('dt_fn'));

        return view('movimentacoes/simcard_pesq', compact('simcard','movs'));
    }

    public function rastreadores(){
        $rastreadores = Rastreador::all()->sortBy('cod_rastreador');

        return view('movimentacoes/rastreadores', compact('rastreadores'));
    }

    public function rastreadores_gerar(Request $request){
        $rastreador = Rastreador::where('id', $request->get('rastreador_id'))->first();
        $movs = Movimentacaorastreador::pesq_movimentacao($request->get('rastreador_id'), $request->get('dt_inc'), $request->get('dt_fn'));

        return view('movimentacoes/rastreador_pesq', compact('rastreador','movs'));
    }
}
