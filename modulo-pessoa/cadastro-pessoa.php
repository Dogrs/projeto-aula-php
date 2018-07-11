<?php
include '../config.php';

function exibirErro($listaErros, $chave)
{
    if ( isset($listaErros[$chave]) && $listaErros[$chave]) {
        return '<span class="text-danger">' . $listaErros[$chave] . '</span>';
    }
    return '';
}

/**
 * Valida formulario simples
 */
function validarFormularioSimples($post) 
{
    $listaErros = [];

    if (!$post['nome']) {
        $listaErros['nome'] = "Nome obrigatório.";
    }

    if (!$post['email']) {
        $listaErros['email'] = "Email obrigatório.";
    } else if ( !validarEmail($post['email']) ) {
        $listaErros['email'] = "Informe um email válido.";
    }

    if (!$post['sexo']) {
        $listaErros['sexo'] = "Selecione um sexo.";

    } else if ( !in_array($post['sexo'], ['M', 'F']) ) {
        // o IF acima equivale ao IF comentado abaixo
        // if ($post['sexo'] != 'M' && $post['sexo'] != 'F' )
        $listaErros['sexo'] = "Selecione Masculino ou Feminino.";
    }
    
    if (!$post['data_nascimento']) {
        $listaErros['data_nascimento'] = "Data de nascimento obrigatória.";
    }

    if (!$post['uf']) {
        $listaErros['uf'] = "Estado obrigatório.";
    }

    if (!$post['cidade']) {
        $listaErros['cidade'] = "Cidade obrigatória.";
    }

    return $listaErros;
}


/**
 * Recebe o array $post contendo osvalores do $_POST,
 * e um array contendo as chaves do array $post
 */
function validarFormularioAvancado($post, $chaves)
{
    $listaErros = [];

    foreach($chaves as $chave) {
        $valido = false;

        if (isset($post[$chave])) {
            if ($post[$chave]) {
                $valido = true;
            }
        }
        if (!$valido) {
          $listaErros[$chave] = "Campo obrigatório.";
        }
    }
    return $listaErros;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    include "cadastro-view.php";

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Formulario enviado <br>";
    
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormularioSimples($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);

    if (count($listaErros) > 0) {
        include "cadastro-view.php";
    }
    
    echo $_POST['nome'];
    echo "<br>";
    /*
    echo $_POST['email'];
    echo '<br>';
    echo $_POST['sexo'];
    echo '<br>';
    echo $_POST['data_nascimento'];
    echo '<br>';
    echo $_POST['uf'];
    echo '<br>';
    echo $_POST['cidade'];
    */
}



?>