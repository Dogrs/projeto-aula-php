<?php
    include "../config.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $listaErros = [];
        $mensagemSucesso = "";

        if (isset($_GET['delete']) && isset($_GET['id']) 
                && $_GET['delete']== '1' && $_GET['id'])
        {
            //chama função em UTILS, que deleta o id xxx da tabela uf do banco
            $deletado = deletarRegistro($_GET['id'], 'uf'); 
            if ($deletado) 
            {
                //dd($_GET);
                $_SESSION['msg_sucesso'] = [
                    'title' => 'Sucesso.  ',
                    'icon' => 'fa fa-warning',
                    'message' => "Estado {$_POST['nome']} removido com sucesso.",
                ];
            } 
            else 
            {
                $_SESSION['msg_erro'] = [
                    'title' => 'ERRO.  ',
                    'icon' => 'fa fa-warning',
                    'message' => "Erro ao Excluir o Estado {$_POST['nome']}.",
                ];
            }
        }
        $listaEstados = select_db("
                        SELECT 
                            id AS estado_id, 
                            nome AS estado_nome, 
                            sigla AS estado_sigla 
                        FROM 
                            uf
                        ORDER BY 
                            nome ASC
                            ");
        //dd($listaEstados);
        include "list.php";
    }
?>
