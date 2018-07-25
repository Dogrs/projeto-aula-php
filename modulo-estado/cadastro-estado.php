<?php
include '../config.php';

function exibirErro($listaErros, $chave)
{
    if ( isset($listaErros[$chave]) && $listaErros[$chave]) {
        return '<span class="text-danger">' . $listaErros[$chave] . '</span>';
    }
    return '';
}

/**
 * Valida formulario simples
 */
function validarFormularioSimples($post) 
{
    $listaErros = [];

    if (!$post['nome']) {
        $listaErros['nome'] = "Nome obrigatório.";
    }

    //dd(strlen($post['sigla']));
    
    
    function validarSigla($sigla){ //Valida siglas, verifica se tem 2 caracteres e se são letras
        $padrao = "/^([a-zA-Z]{2})$/";
        if(preg_match($padrao,$sigla)){ return true;}
        return false;
    }

    if (!isset ($post['sigla'])  || !$post['sigla']){
        $listaErros['sigla'] = "Estado obrigatório.";
    } 
    
 //   else if (strlen($post['sigla']) != 2) { //verificação simples de se tem 2 caracteres... funcionando
     else if (!validarSigla($post['sigla']) ){ //verifica se tem 2 caracteres letras
        $listaErros['sigla'] = "Informe uma sigla com 2 letras.";
   }

   
    return $listaErros;
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    include "cadastro-view.php";

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Formulario enviado <br>";
    
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormularioSimples($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);

    if (count($listaErros) > 0) {
        include "cadastro-view.php";
     }else {

        //dd($_POST); //Teste para ver oque está enviando
        $sql = "INSERT INTO uf (nome,sigla) 
        VALUES('".$_POST['nome']."', '".strtoupper ($_POST['sigla']) ."');";
        //$sql = "INSERT INTO uf (nome,sigla) VALUES('xx','yy') " --> outra forma de fazer as string do SQL 1a PARTE coloca xx e yy
        //$sql = "INSERT INTO uf (nome,sigla) VALUES('{}','{}') " --> Substitui por Chaves
        //$sql = "INSERT INTO uf (nome,sigla) VALUES('{$_POST['nome']}','{$_POST['sigla']}') "  --> ajuste com o campo, porem não funciona to UPPER
        
        //$sigla = strtoupper($_POST['sigla']); // Criada uma variavel tudo em Maiusculo para usar o código de cima
        //$sql = "INSERT INTO uf (nome,sigla) VALUES('{$_POST['nome']}','{$sigla}') " --> agora usando a variavel, gravamos o texto em UPPER
        
            //dd($sql); // Teste para ver o resultado do SQL que será enviado.

        $estadoId = insert_db($sql); // chama a função que grava no banco   
        $mensagemSucesso = '';
        $mensagemErro = '';
        //dd($estadoId); // testa resultado após inserir

            
        if ($estadoId) {
            $mensagemSucesso= "Estado cadastrada com sucesso";
        } else{
            $mensagemErro = "Erro Inesperado";
        }

        include "cadastro-view.php";
     }
}



?>