<?php
    include "../config.php";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $listaErros = [];

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
                            A.id ASC;
                                ");
        //dd($listaCidades);

        include "list.php";
    }


?>
