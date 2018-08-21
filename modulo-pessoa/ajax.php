
<?php
/*
Este arquivo deve ser chamado somente em requisições via Ajax.
Devemos enviar na requisição o parametro "uf_id" contendo o ID do estado
 para que possamos buscar todas as cidades deste estado no Banco de Dados.
*/

include '../config.php';
if (!checkAjax()) {
    die();
}
// Quando vier o parametro 'uf_id' na requisição, pegamos ele através da variavel global $_GET['uf_id'].
if (isset($_GET['uf_id']) && $_GET['uf_id'] ) {
    $listaCidades = select_db("SELECT id, nome FROM cidade WHERE uf_id = {$_GET['uf_id']};");
    sleep(2);
    echo json_encode($listaCidades);
}
?>