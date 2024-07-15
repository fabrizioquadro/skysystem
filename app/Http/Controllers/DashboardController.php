<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Rastreador;
use App\Models\Simcard;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Instalacao;

class DashboardController extends Controller
{
    public function index(){
        $nr_clientes = Cliente::all()->count();
        $nr_veiculos = Veiculo::all()->count();
        $nr_rastreadores = Rastreador::all()->count();
        $nr_simcards = Simcard::all()->count();
        $nr_instalacoes = Instalacao::all()->count();
        $nr_instalacoes_ativas = Instalacao::where('st_instalacao','Instalado')->count();

        //vamos verificar os produtos minimos
        $estoque_adm = Estoque::getEstoqueAdm();

        $array_produtos = array();
        if($estoque_adm){
            $produtos = Produto::all()->sortBy('nm_produto');
            foreach($produtos as $produto){
                $nr_estoque_prod = Estoque::getEstoqueProduto($estoque_adm->id, $produto->id);
                if($nr_estoque_prod < $produto->qt_minima){
                    $array = array();
                    $array['nm_produto'] = $produto->nm_produto;
                    $array['nm_marca'] = $produto->marca->nm_marca;
                    $array['ds_unidade'] = $produto->ds_unidade;
                    $array['qt_minima'] = $produto->qt_minima;
                    $array['qt_produto'] = $nr_estoque_prod;

                    $array_produtos[] = $array;
                }
            }
        }


        return view('dashboard/index', compact('nr_clientes','nr_veiculos',
        'nr_rastreadores','nr_simcards','array_produtos','nr_instalacoes','nr_instalacoes_ativas'));
    }

    public function alterarSenha(){
        return view('dashboard/alterarSenha');
    }

    public function alterarImagem(){
        return view('dashboard/alterarImagem');
    }

    public function setNovaSenha(Request $request){
        $dados['password'] = bcrypt($request->get('password'));
        User::where('id', auth()->user()->id)->update($dados);

        return redirect()->route('dashboard')->with('mensagem', "Senha Alterada");
    }

    public function setNovaImagem(Request $request){
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){

            $id = auth()->user()->id;
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $id.".".$extensao;
            $dadosUpdate['imagem'] = $nmImagem;

            $request->imagem->move(public_path('img/usuarios'), $nmImagem);

            User::where('id', $id)->update($dadosUpdate);

            return redirect()->route('dashboard')->with('mensagem', "Imagem Alterada");
        }

    }
}
