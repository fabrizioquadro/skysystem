<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Movimentacaoferramenta;
use App\Models\Movimentacaosimcard;
use App\Models\Movimentacaorastreador;
use Illuminate\Support\Facades\Auth;

if(!function_exists('insertMovFerramenta')){
    function insertMovFerramenta($ferramenta, $ds_movimentacao, $vl_manutencao = null){
        $ds_movimentacao .= "<br>
        Dados Patrimônio/Ferramenta:<br>
        ID = $ferramenta->id <br>
        Marca = ".$ferramenta->marca->nm_marca." <br>
        Nome = ".$ferramenta->nm_ferramenta." <br>
        Descrição = $ferramenta->ds_ferramenta <br>
        Valor = $ferramenta->vl_ferramenta <br>
        ";
        if($ferramenta->estoque){
            $ds_movimentacao .= "Estoque = ".$ferramenta->estoque->nm_estoque." <br>";
        }

        $dados = [
            'ferramenta_id' => $ferramenta->id,
            'ds_movimentacao' => $ds_movimentacao,
            'user_id' => Auth::id(),
            'vl_manutencao' => $vl_manutencao,
        ];

        Movimentacaoferramenta::create($dados);
    }
}

if(!function_exists('insertMovSimcard')){
    function insertMovSimcard($simcard, $ds_movimentacao){
        $ds_movimentacao .= "<br>
        Dados Simcard:<br>
        ID = $simcard->id <br>
        Operadora = ".$simcard->operadora->nm_operadora." <br>
        Telefone = ".$simcard->nr_tel." <br>
        ICC = $simcard->nr_icc <br>
        Situação = $simcard->st_simcard <br>";

        if($simcard->rastreador){
            $ds_movimentacao .= "Rastreador: Cod ".$simcard->rastreador->cod_rastreador." Marca ".$simcard->rastreador->marca->nm_marca." Tipo ".$simcard->rastreador->tipo->nm_tipo_rastreador." Modelo ".$simcard->rastreador->modelo->nm_modelo."<br>";

            if($simcard->rastreador->veiculo){
                $ds_movimentacao .= "Veículo = ".$simcard->rastreador->veiculo->cliente->nm_cliente.", ".$simcard->rastreador->veiculo->marca->nm_marca." ".$simcard->rastreador->veiculo->ds_modelo." Placa ".$simcard->rastreador->veiculo->nr_placa." Chassi ".$simcard->rastreador->veiculo->nr_chassi."<br>";
            }
            else{
                $ds_movimentacao .= "Veículo: não vinculado.<br>";
            }
        }
        else{
            $ds_movimentacao .= "Rastreador: null <br>";
        }

        $dados = [
            'simcard_id' => $simcard->id,
            'ds_movimentacao' => $ds_movimentacao,
            'user_id' => Auth::id(),
        ];

        Movimentacaosimcard::create($dados);
    }
}

if(!function_exists('insertMovRastreador')){
    function insertMovRastreador($rastreador, $ds_movimentacao){
        $ds_movimentacao .= "<br>
        Dados Rastreador:<br>
        Cod = $rastreador->cod_rastreador <br>
        Marca = ".$rastreador->marca->nm_marca." <br>
        Tipo = ".$rastreador->tipo->nm_tipo_rastreador." <br>
        Modelo = ".$rastreador->modelo->nm_modelo." <br>
        Situação = $rastreador->st_rastreador <br>
        ";

        if($rastreador->estoque){
            $ds_movimentacao .= "Estoque = ".$rastreador->estoque->nm_estoque."<br>";
        }
        else{
            $ds_movimentacao .= "Estoque = null<br>";
        }

        if($rastreador->simcard){
            $ds_movimentacao .= "Simcard = Operadora: ".$rastreador->simcard->operadora->nm_operadora.", Tel: ".$rastreador->simcard->nr_tel.", ICC: ".$rastreador->simcard->nr_icc."<br>";
        }
        else{
            $ds_movimentacao .= "Simcard = Não vinculado<br>";
        }

        if($rastreador->veiculo){
            $ds_movimentacao .= "Veículo = ".$rastreador->veiculo->cliente->nm_cliente.", ".$rastreador->veiculo->marca->nm_marca." ".$rastreador->veiculo->ds_modelo." Placa ".$rastreador->veiculo->nr_placa." Chassi ".$rastreador->veiculo->nr_chassi."<br>";
        }
        else{
            $ds_movimentacao .= "Veículo = Não vinculado<br>";
        }

        $dados = [
            'rastreador_id' => $rastreador->id,
            'ds_movimentacao' => $ds_movimentacao,
            'user_id' => Auth::id(),
        ];

        Movimentacaorastreador::create($dados);
    }
}

if(!function_exists('createPassword')){
    function createPassword($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        $senha = "";
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }

        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }

        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }

        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);

    }
}

if(!function_exists('dataDbForm')){
    function dataDbForm($data){
        $data = explode("-", $data);
        $data = $data[2]."/".$data[1]."/".$data[0];
        return $data;
    }
}

if(!function_exists('dataFormDb')){
    function dataFormDb($data){
        $data = explode("/", $data);
        $data = $data[2]."-".$data[1]."-".$data[0];
        return $data;
    }
}

if(!function_exists('valorFormDb')){
    function valorFormDb($valor){
        //vamos procurar se foi digitado a ,
        $virgula = strpos($valor, ',');

        if($virgula === false){
            $valor = str_replace(".","",$valor);
            $valor = $valor.".00";
            return $valor;
        }

        $var = explode(',', $valor);
        $variavel = $var[1];
        $var = str_replace('.', '', $var[0]);
        $valor = $var.'.'.$variavel[0].$variavel[1];
        return $valor;
    }
}

if(!function_exists('valorDbForm')){
    function valorDbForm($valor){
        return number_format($valor,2,",",".");
    }
}

if(!function_exists('enviarMail')){
    function enviarMail($destinatario, $assunto, $mensagem){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->setLanguage('br');
            $mail->CharSet = "utf8";
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'teste@webpel.eu.org';
            $mail->Password = 'P&dr0Quadr0';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->FromName = "Sky System";
            $mail->From = "teste@webpel.eu.org";
            $mail->IsHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $mensagem;
            $mail->AddAddress($destinatario);
            $mail->Send();
        }
        catch (Exception $e) {
            die($mail->ErrorInfo);
        }
    }
}
?>
