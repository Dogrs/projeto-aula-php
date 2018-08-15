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
    return $SITE_URL;
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
function validarEmail($email) 
{
    $conta = "/^[a-zA-Z0-9\._-]+@";
    $domino = "[a-zA-Z0-9\._-]+.";
    $extensao = "([a-zA-Z]{2,4})$/";
    $pattern = $conta.$domino.$extensao;

    if (preg_match($pattern, $email)) {return true;}
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
    
    /*$retorno = false;
    $lista = select_db("SELECT id, nome FROM " . $tableName . " WHERE id = " . $id);
    if (count($lista) > 0 && $lista[0]->id) 
    {
        $retorno = delete_db("DELETE FROM {$tableName} WHERE id = {$id}");
    }
    return $retorno;*/

    return delete_db("DELETE FROM {$tableName} WHERE id = {$id}");
}

/**
 * Direciona o usuario para a $url recebida no parametro.
 */
function redirect($url){die("<script>window.location.href = '{$url}';</script>");}

function alertSuccess($titulo, $mensagem, $delay=3000, $icone='fa fa-warning') 
{
    $_SESSION['msg_sucesso'] = [
        'title' => $titulo,
        'icon' => $icone,
        'message' => $mensagem,
        'type' => "success",
        'delay' => $delay,
    ];
}

function alertError($titulo, $mensagem, $delay=3000, $icone='fa fa-warning')
 {
    $_SESSION['msg_erro'] = [
        'title' => $titulo,
        'icon' => $icone,
        'message' => $mensagem,
        'type' => "danger",
        'delay' => $delay,
    ];
}

function removerMascaraCpf($valor)
{
    return preg_replace(["/\\D+/"], [''], $valor);
}

function validarCpf($cpf)
{
    $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT); 
    //Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if ( strlen($cpf) != 11
        || $cpf == '00000000000'
        || $cpf == '11111111111'
        || $cpf == '22222222222'
        || $cpf == '33333333333'
        || $cpf == '44444444444'
        || $cpf == '55555555555'
        || $cpf == '66666666666'
        || $cpf == '77777777777'
        || $cpf == '88888888888'
        || $cpf == '99999999999') {
        return false;
    } else {
        // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }
}

function adicionarMascaraCpf($valor)
{
    return vsprintf('%s%s%s.%s%s%s.%s%s%s-%s%s', str_split($valor));
}


function ValidaData($dat){
	$data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referência
	$d = $data[0];
	$m = $data[1];
	$y = $data[2];

	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)
	$res = checkdate($m,$d,$y);
	if ($res == 1){
	   echo "data ok!";
	} else {
	   echo "data inválida!";
	}
}

//Exemplo de chamada a função
//ValidaData("31/02/2002")


?>