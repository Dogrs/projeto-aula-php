<?php //modulo-cidade/index.php
    include "../config.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        $listaErros = [];
        $mensagemSucesso = "";

        if (isset($_GET['delete']) && isset($_GET['id']) 
                && $_GET['delete']== '1' && $_GET['id'])
        {
            $cidade = select_one_db("SELECT nome FROM cidade WHERE id={$_GET['id']};");
            $deletado = deletarRegistro($_GET['id'], 'cidade');
            if ($deletado) {alertSuccess("Sucesso.", "A cidade {$cidade->nome} removida com sucesso.");}
            else {alertError('Atenção!', "Erro ao remover o cidade.");}
        }

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
