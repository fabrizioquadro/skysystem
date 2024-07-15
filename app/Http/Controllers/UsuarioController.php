<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::all();

        return view('usuarios/index', compact('usuarios'));
    }

    public function adicionar(){
        return view('usuarios/adicionar');
    }

    public function insert(Request $request){
        $dados = $request->only('nome','email','tipo','password');

        $user = User::create($dados);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){

            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $user->id.".".$extensao;
            $dadosUpdate['imagem'] = $nmImagem;

            $request->imagem->move(public_path('img/usuarios'), $nmImagem);

            $user->imagem = $nmImagem;

            $user->save();

        }

        return redirect()->route('usuarios')->with('mensagem', "Usuário cadastrado!");
    }

    public function editar($id){
        $user = User::where('id', $id)->first();

        return view('usuarios/editar', compact('user'));
    }

    public function update(Request $request){
        $id = $request->get('user_id');
        $dados = $request->only('nome','email','tipo');

        User::where('id', $id)->update($dados);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){

            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $id.".".$extensao;
            $dadosUpdate['imagem'] = $nmImagem;

            $request->imagem->move(public_path('img/usuarios'), $nmImagem);

            User::where('id', $id)->update($dadosUpdate);
        }

        return redirect()->route('usuarios')->with('mensagem', "Usuário editado!");
    }

    public function excluir($id){
        $user = User::where('id', $id)->first();

        return view('usuarios/excluir', compact('user'));
    }

    public function delete(Request $request){
        $id = $request->get('user_id');
        User::where('id', $id)->delete();

        return redirect()->route('usuarios')->with('mensagem', "Usuário excluído!");
    }

}
