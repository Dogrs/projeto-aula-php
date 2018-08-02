<?php
include '../config.php';
/**
 * Valida formulario simples
 */
function validarFormularioSimples($post) 
{
    $listaErros = [];
    if (!isset($post['nome']) || !$post['nome'] ) {
        $listaErros['nome'] = "Nome obrigatório.";
    }
    if ( !isset($post['uf']) || !$post['uf'] ) {
        $listaErros['uf'] = "Estado obrigatório.";
    }
    return $listaErros;
}
// Busca todos os UFs (estados) do banco 
$listaUf = select_db("SELECT id, nome, sigla FROM uf;");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    if (isset($_GET['edit']) && isset($_GET['id']) 
        && $_GET['edit'] == '1' && $_GET['id']) {
            $cidade = select_one_db("SELECT id, nome, uf_id FROM cidade WHERE id={$_GET['id']}");
        }
    include "cadastro-view.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Formulario enviado <br>";
    
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormularioSimples($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);
    if (isset($_POST['id']) && $_POST['id'] )  {
        $cidade = select_one_db("SELECT id, nome, uf_id FROM cidade WHERE id = {$_POST['id']}");
    }
    if (count($listaErros) > 0) {
        include "cadastro-view.php";
    } else if (isset($_POST['id']) && $_POST['id'] ) {
        
        // Executo o update
        $sql = "UPDATE cidade 
            SET nome = '{$_POST['nome']}', 
            uf_id = {$_POST['uf']}
            WHERE id = {$_POST['id']};
        ";
        $alterado = update_db($sql);
        //$_SESSION['msg_sucesso'] = "Cidade {$_POST['nome']} alterada com sucesso.";
        $_SESSION['msg_sucesso'] = [
            'title' => 'Sucesso.',
            'icon' => 'fa fa-warning',
            'message' => "Cidade {$_POST['nome']} alterada com sucesso.",
        ];
        redirect("/modulo-cidade/");
    
    } else {
        // Executa o insert
        $sql = "INSERT INTO cidade (nome, uf_id) 
            VALUES('" . $_POST['nome'] . "', " . $_POST['uf'] . ");";
        $cidadeId = insert_db($sql);
        // Variaveis para controle de erros.
        $mensagemSucesso = '';
        $mensagemErro = '';
        if ($cidadeId) {
            $mensagemSucesso = "Cidade cadastrada com sucesso.";
        } else {
            $mensagemErro = "Erro inesperado.";
        }
        include "cadastro-view.php";
        
    }
}
?>