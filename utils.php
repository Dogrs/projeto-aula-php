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
 * Dump: debugar codigo sem interromper o processo.
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


?>