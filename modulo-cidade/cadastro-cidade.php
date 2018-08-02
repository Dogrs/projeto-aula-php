<?php
include '../config.php';

/**
 * Valida formulario simples
 */
function validarFormularioSimples($post) 
{
    $listaErros = [];

    if (!$post['nome']) {
        $listaErros['nome'] = "Nome obrigatório.";
    }


    if (!isset ($post['uf'])  || !$post['uf']){
        $listaErros['uf'] = "Estado obrigatório.";
    }

   
    return $listaErros;
}



//Busca todos os UFs do banco
$listaUf = select_db("SELECT id, nome, sigla FROM uf ORDER BY 2;");
//dd($listaUf); --> gera o resultado na tela como teste



if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $listaErros = [];
    if (isset($_GET['edit']) && isset($_GET['id'])) && $_GET['edit'] == 1 && $_GET['id']
    {
        $lista = select_one_db("SELECT id, nome, uf_id FROM cidade WHERE id ={$_GET['id]}");
                
    }

    include "cadastro-view.php";

}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    echo "Formulario enviado <br>";
    
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormularioSimples($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);

    if (count($listaErros) > 0) {
        include "cadastro-view.php";
     }else {

        //dd($_POST); //Teste para ver oque está enviando
        $sql = "INSERT INTO cidade (nome,uf_id) 
        VALUES('".$_POST['nome']."', ".$_POST['uf'] .");";

        //dd($sql); // Teste para ver o resultado do SQL que será enviado.

        $cidadeId = insert_db($sql); // chama a função que grava no banco   
        $mensagemSucesso = '';
        $mensagemErro = '';
        //dd($cidade_id); // testa resultado após inserir

            
        if ($cidadeId) {
            $mensagemSucesso= "Cidade cadastrada com sucesso";
        } else{
            $mensagemErro = "Erro Inesperado";
        }

        include "cadastro-view.php";
     }



    /*
    echo $_POST['nome'];
    echo "<br>";
    echo $_POST['email'];
    echo '<br>';
    echo $_POST['sexo'];
    echo '<br>';
    echo $_POST['data_nascimento'];
    echo '<br>';
    echo $_POST['uf'];
    echo '<br>';
    echo $_POST['cidade'];
    */
}



?>