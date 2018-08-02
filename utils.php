<?php
/**
 * Funções úteis do projeto.
 */

/**
 * Retorna a URL raiz do site atual;
 * 
 */
function site_url()
{
    return null;
}

/**
 * Dump and Die : debugar codigo interrompendo a execução.
 */
function dd($valor) 
{
    echo '<pre style="background-color: #FFF !important; color: #000 !important; ">';
    var_dump($valor);
    echo '</pre>';
    die;
}

/**
 * Dump: debugar codigo sem interromper o processo.TESTE
 */
function d($valor)
{
    echo '<pre style="background-color: #FFF !important; color: #000 !important; ">';
    var_dump($valor);
    echo '</pre>';
}

/**
 * Valida o email
 */
function validarEmail($email) {
    $conta = "/^[a-zA-Z0-9\._-]+@";
    $domino = "[a-zA-Z0-9\._-]+.";
    $extensao = "([a-zA-Z]{2,4})$/";
    $pattern = $conta.$domino.$extensao;

    if (preg_match($pattern, $email)) {
        return true;
    }
    return false;
}

/**
 * Exibe erros de um array pegando pela chave.
 */
function exibirErro($listaErros, $chave)
{
    if (isset($listaErros[$chave]) && $listaErros[$chave]) 
    {
        return '<span class="text-danger">' . $listaErros[$chave] . '</span>';
    }
    return '';
}

function deletarRegistro($id, $tableName)
 {
    // String do SQL utilizando chaves ({}) para concatenar.
    //$lista = select_db("SELECT id, nome FROM {$tableName} WHERE id = {$id}");
    // String do SQL utilizando ponto (.) para concatenar.
    $retorno = false;
    $lista = select_db("SELECT id, nome FROM " . $tableName . " WHERE id = " . $id);
    if (count($lista) > 0 && $lista[0]->id) 
    {
        $retorno = delete_db("DELETE FROM {$tableName} WHERE id = {$id}");
    }
    return $retorno;
}

/**
 * Direciona o usuario para a $url recebida no parametro.
 */
function redirect($url){die("<script>window.location.href = '{$url}';</script>");}
?>