<?php //modulo-pessoa/index.php
    include "../config.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $listaErros = [];
        $mensagemSucesso = "";

        if (isset($_GET['delete']) && isset($_GET['id']) 
                && $_GET['delete']== '1' && $_GET['id'])
        {
            $pessoa = select_one_db("SELECT primeiro_nome FROM pessoa WHERE id={$_GET['id']};");
                    
            $deletado = deletarRegistro($_GET['id'], 'pessoa');
            if ($deletado) {alertSuccess("Sucesso", "pessoa {$pessoa->primeiro_nome} removido com sucesso.");}
            else {alertError('Atenção!', "Falha ao tentar remover a pessoa.", 10000);}
        }
    
    $listaPessoas   = select_db("SELECT id, primeiro_nome, segundo_nome, cpf FROM pessoa ORDER BY primeiro_nome ASC");
    //dd($listaUfs);
    include "list.php";
    }
?>
