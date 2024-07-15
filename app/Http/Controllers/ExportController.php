<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function imprimir(Request $request){
        $dados = $request->get('dados_impimir');
        $nm_pagina = $request->get('nm_pagina');

        return view('export/imprimir', compact('dados','nm_pagina'));
    }
}
