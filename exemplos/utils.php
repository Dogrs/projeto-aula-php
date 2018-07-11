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
 * Exibe um LOG formatado;
 */
function dd($valor)
{

    echo "<pre style=\"background-color: #FFF; position: absolute; z-index: 99999; width: 100%;\">";
    var_dump($valor);
    echo "</pre>";

}

?>