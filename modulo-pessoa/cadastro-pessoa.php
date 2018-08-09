<?php
include '../config.php';

/**
 * Valida formulario simples
 */
function validarSigla($sigla) //Valida siglas, verifica se tem 2 caracteres e se são letras
{
    $padrao = "/^([a-zA-Z]{2})$/";
    if(preg_match($padrao,$sigla)){ return true;}
    return false;
}

function validarFormularioSimples($post) 
{
    $listaErros = [];
    if (!isset($post['nome']) || !$post['nome']) 
    {
        $listaErros['nome'] = "Nome obrigatório.";
    }



    if (!isset ($post['sigla'])  || !$post['sigla'])
    {
        $listaErros['sigla'] = "pessoa obrigatório.";
    } 
    else if (!validarSigla($post['sigla']))//verifica se tem 2 caracteres letras
    {
        $listaErros['sigla'] = "Informe uma sigla com 2 letras.";
    }
    //   else if (strlen($post['sigla']) != 2) { //verificação simples de se tem 2 caracteres... funcionando  
    return $listaErros;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        $listaErros = [];
        if (isset($_GET['edit']) && isset($_GET['id']) 
        && $_GET['edit'] == '1' && $_GET['id']) 
        {
            $uf = select_one_db("SELECT id, nome, sigla FROM uf WHERE id={$_GET['id']}");
        }
        include "cadastro-view.php";    
    } 
else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $listaErros = validarFormularioSimples($_POST);

        if (isset($_POST['id']) && $_POST['id'] )
        {
            $uf = select_one_db("SELECT id, nome, sigla FROM uf WHERE id = {$_POST['id']}");
        }

        
        if (count($listaErros) > 0) {include "cadastro-view.php";}
        else if (isset($_POST['id']) && $_POST['id'])
        {
            // Executo o update
            $sql = "UPDATE uf SET nome = '{$_POST['nome']}', sigla = '".strtoupper ($_POST['sigla'])."' WHERE id = {$_POST['id']};";
            //dd($sql);
            $alterado = update_db($sql);
            alertSuccess("Sucesso.", "pessoa {$_POST['nome']} alterado com sucesso.");
            redirect("/modulo-pessoa/");
        } 
        else 
        {
            // Executa o insert
            $sql = "INSERT INTO uf (nome,sigla) 
            VALUES('".$_POST['nome']."', '".strtoupper ($_POST['sigla'])."');";
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('xx','yy') " --> outra forma de fazer as string do SQL 1a PARTE coloca xx e yy
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('{}','{}') " --> Substitui por Chaves
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('{$_POST['nome']}','{$_POST['sigla']}') "  --> ajuste com o campo, porem não funciona to UPPER
            //$sigla = strtoupper($_POST['sigla']); // Criada uma variavel tudo em Maiusculo para usar o código de cima
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('{$_POST['nome']}','{$sigla}') " --> agora usando a variavel, gravamos o texto em UPPER

            $pessoaId = insert_db($sql);
            $mensagemSucesso = '';
            $mensagemErro = '';

            if ($pessoaId) {$mensagemSucesso = "pessoa cadastrado com sucesso.";}
            else {$mensagemErro = "Erro Inesperado";}
            include "cadastro-view.php";
        }
    }
?>