<?php
include '../config.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    $mensagemSucesso = "";
    if (isset($_GET['delete']) && isset($_GET['id'])
        && $_GET['delete'] == '1' && $_GET['id']) {
        
        $pessoa = select_one_db("SELECT primeiro_nome, segundo_nome FROM pessoa WHERE id={$_GET['id']};");
        
        $deletado = deletarRegistro($_GET['id'], 'pessoa');
    
        if ($deletado) {
            alertSuccess("Sucesso", "Pessoa {$pessoa->primeiro_nome} {$pessoa->segundo_nome} removido com sucesso.");
        } else {
            alertError('Atenção!', "Erro ao remover pessoa.");
        }
        
        redirect('/modulo-pessoa/');
    }
    // Monta o SQL de ordenacao para o ORDER BY
    $nomeTabela = 'pessoa';
    if (isset($_GET['order']) && $_GET['order']) {
        $order_by = "{$nomeTabela}.{$_GET['order']}";
        if (isset($_GET['order_type']) && $_GET['order_type']) {
            $order_by = "{$order_by} {$_GET['order_type']}";
        }
        
    } else {
        // Caso nao venha parametros de ordenacao no GET.
        $order_by = 'pessoa.ID ASC';
    }
    // Variaveis de paginacao
    $pagina = 0;
    if (isset($_GET['p']) && $_GET['p']) {
        $pagina = $_GET['p'] - 1;
    }
    $limite = 5;
    $offset = $pagina * $limite;
  
    // Busca total de registros da tabela pessoa
    $buscaTotal = select_one_db("SELECT count(id) AS count FROM pessoa");
    $total = (int) ($buscaTotal->count / $limite);
    // Fazer a busca das pessoas e exibir a pagina list.php
    $listaPessoas = select_db("
        SELECT 
            id,
            primeiro_nome,
            segundo_nome,
            cpf,
            email
        FROM pessoa
        ORDER BY {$order_by}
        LIMIT {$limite}
        OFFSET {$offset};
    ");
    
    include "list.php";
}
?>