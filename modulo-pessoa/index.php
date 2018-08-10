<?php //modulo-pessoa/index.php
    include "../config.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        $listaErros = [];
        $mensagemSucesso = "";

        if (isset($_GET['delete']) && isset($_GET['id']) 
                && $_GET['delete']== '1' && $_GET['id'])
        {
            $uf = select_one_db("SELECT nome FROM uf WHERE id={$_GET['id']};");
            $quantidadeCidades = select_one_db("SELECT count(id) AS count FROM cidade WHERE uf_id = {$_GET['id']};");
        
        if ($quantidadeCidades->count == 0) 
        {
            $deletado = deletarRegistro($_GET['id'], 'uf');
            if ($deletado) {alertSuccess("Sucesso", "pessoa {$uf->nome} removido com sucesso.");} 
            else {alertError('Atenção!', "Erro ao remover pessoa.");}
        } 
        else {alertError('Atenção!', "Existem {$quantidadeCidades->count} cidades para este pessoa. Remova todas as cidades antes de remover o pessoa.", 10000);}
        redirect('/modulo-pessoa/');
    }
        
    $listaUfs = select_db("SELECT id, nome, sigla FROM uf ORDER BY uf.nome ASC");
    //dd($listaUfs);
    include "list.php";
}
?>
