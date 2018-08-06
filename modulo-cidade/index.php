<?php
    include "../config.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $listaErros = [];
        $mensagemSucesso = "";

        if (isset($_GET['delete']) && isset($_GET['id']) 
                && $_GET['delete']== '1' && $_GET['id'])
        {
            $deletado = deletarRegistro($_GET['id'], 'cidade');
            if ($deletado) 
            {
                $_SESSION['msg_sucesso'] = [
                    'title' => 'Sucesso.  ',
                    'icon' => 'fa fa-warning',
                    'message' => "Cidade {$_POST['nome']} removida com sucesso.",
                ];
                //$mensagemSucesso = "Cidade removida com sucesso.";
            } 
            else 
            {
                // alterar classe msg_sucesso para msg_ERRO
                //$listaErros['delete'] = "Erro ao remover o cidade.";
                $_SESSION['msg_erro'] = [
                    'title' => 'ERRO.  ',
                    'icon' => 'fa fa-warning',
                    'message' => "Erro ao Excluir a cidade {$_POST['nome']}.",
                ];
            }

            /*
            $lista=select_db("SELECT id,nome from cidade WHERE id =" . $_GET['id']);
            if (count($lista) > 0 && $lista[0]->id)
            {
                $deletado = delete_db("DELETE from cidade WHERE id=" . $_GET['id']);
                if ($deletado)
                {
                    $mensagemSucesso = "Cidade {$lista[0]->nome} removida com sucesso.";
                } 
                else 
                {
                    $listaErros['delete'] = "Erro ao remover o registro id = {$_GET['id']}.";
                }
            }*/
        }

        //$listaCidades = select_db("SELECT id, nome, uf_id FROM cidade ORDER BY nome ASC, id ;");
        $listaCidades = select_db("
                        SELECT 
                            A.id AS cidade_id,
                            A.nome AS cidade_nome,
                            B.id AS estado_id,
                            B.nome AS uf_nome,
                            B.sigla AS uf_sigla
                        FROM 
                            cidade as A
                            INNER JOIN uf AS B ON(B.id = A.uf_id)
                        ORDER BY
                            A.nome ASC;
                                ");
        //dd($listaCidades);

        include "list.php";
    }


?>
