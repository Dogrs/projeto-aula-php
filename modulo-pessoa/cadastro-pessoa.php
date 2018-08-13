<?php
include '../config.php';


/**
 * Valida formulario simples
 */
function validarSigla($sigla) //Valida siglas, verifica se tem 2 caracteres e se são letras
{
    $padrao = "/^([a-zA-Z]{2})$/";
    if(preg_match($padrao,$sigla)){ return true;}
    return false;
}


function validarFormularioSimples($post) 
{//dd($post);
    $listaErros = [];
   // dd($post);
    
    if (!isset($post['primeiro_nome']) || !$post['primeiro_nome']) {$listaErros['primeiro_nome'] = "Primeiro nome obrigatório.";}
    if (!isset($post['segundo_nome']) || !$post['segundo_nome']) {$listaErros['segundo_nome'] = "Segundo nome obrigatório.";}
    
    if (!isset($post['email']) || !$post['email']) {$listaErros['email'] = "E-mail obrigatório.";}
    else if ( !validarEmail($post['email']) ) {$listaErros['email'] = "Informe um email válido.";}

    if (!isset($post['cpf']) || !$post['cpf']) {$listaErros['cpf'] = "CPF obrigatório.";}
    else
    {
        $cpf_sem_mascara = removerMascaraCpf($post['cpf']);
        if (!validarCpf($cpf_sem_mascara)){$listaErros['cpf'] = "CPF INVÁLIDO.";}
    }

    if (!isset($post['data_nascimento']) || !$post['data_nascimento']) {$listaErros['data_nascimento'] = "Data de Nascimento obrigatória.";}
    if (!isset($post['tipo']) || !$post['tipo']) {$listaErros['tipo'] = "Tipo obrigatório.";}
    if (!isset($post['endereco']) || !$post['endereco']) {$listaErros['endereco'] = "Endereço obrigatório.";}
    if (!isset($post['cep']) || !$post['cep']) {$listaErros['cep'] = "CEP obrigatório.";}
    if (!isset($post['bairro']) || !$post['bairro']) {$listaErros['bairro'] = "Bairro obrigatório.";}
    if (!isset($post['numero']) || !$post['numero']) {$listaErros['numero'] = "Número obrigatório.";}
    if (!isset($post['cidades']) || !$post['cidades']) {$listaErros['cidades'] = "Cidade obrigatório.";}
    if (!isset($post['estado']) || !$post['estado']) {$listaErros['estado'] = "Estado obrigatório.";}

    return $listaErros;
    
}


// Busca todos os UFs (estados) do banco 
$listaUf        = select_db("SELECT id, nome, sigla FROM uf     ORDER BY nome ASC;");
$listaCidades   = select_db("SELECT id, nome, uf_id FROM cidade ORDER BY nome ASC;");

//dd($listaCidades);
//dd($listaUf);

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        //dd($_GET);
        $listaErros = [];
        if (isset($_GET['edit']) && isset($_GET['id']) 
        && $_GET['edit'] == '1' && $_GET['id']) 
        {
            $pessoa = select_one_db("SELECT id, primeiro_nome,segundo_nome,email,cpf,endereco,bairro,numero,cep,cidade_id,data_nascimento,tipo FROM pessoa WHERE id={$_GET['id']}");
        }
 
        include "cadastro-view.php";    
    } 
else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $listaErros = validarFormularioSimples($_POST);
        
        //dd($_POST);
        if (isset($_POST['id']) && $_POST['id'] )
        {
            $pessoa = select_one_db("SELECT id, primeiro_nome,segundo_nome,email,cpf,endereco,bairro,numero,cep,cidade_id,data_nascimento,tipo FROM pessoa WHERE id={$_GET['id']}");
        }
        echo "**** teste1 ****";
        //dd($_POST);
        if (count($listaErros) > 0) {include "cadastro-view.php";}
        else if (isset($_POST['id']) && $_POST['id'])
        { echo "**** teste2 ****";
            dd($_POST);
            $cpf_sem_mascara = removerMascaraCpf($post['cpf']);
            // Executo o update
            $sql = "UPDATE uf SET 
                primeiro_nome   = '{$_POST['primeiro_nome']}', 
                segundo_nome    = '{$_POST['segundo_nome']}',
                email           = '{$_POST['email']}',
                cpf             = '{$cpf_sem_mascara}',
                data_nascimento = '{$_POST['data_nascimento']}',
                tipo            = '{$_POST['tipo']}',
                endereco        = '{$_POST['endereco']}',
                cep             = '{$_POST['cep']}',
                bairro          = '{$_POST['bairro']}',
                numero          = '{$_POST['numero']}',
                cidades         = '{$_POST['cidades']}',
                estado          = '{$_POST['estado']}'
                WHERE id = {$_POST['id']};";
            dd($sql);
            $alterado = update_db($sql);
            alertSuccess("Sucesso.", "pessoa {$_POST['primeiro_nome']} alterado com sucesso.");
            redirect("/modulo-pessoa/");
        } 
        else 
        {
            echo "**** teste3 ****";
        dd($_POST);
            //$sql = "INSERT INTO cidade (nome, uf_id) VALUES('".$_POST['nome']."',".$_POST['uf'].");";
            // Executa o insert
            $novaData = date("Y-m-d",strtotime($_POST['data_nascimento']));
            //DATA = STR_TO_DATE('$name_01', '%d.%m.%Y')
            //dd($novaData);
            $sql = "INSERT INTO pessoa 
                (   primeiro_nome,
                    segundo_nome,
                    email,
                    cpf,
                    data_nascimento,
                    tipo,
                    endereco,
                    cep,
                    bairro,
                    numero,
                    cidade_id) 
                VALUES(
                    '{$_POST['primeiro_nome']}',
                    '{$_POST['segundo_nome']}',
                    '{$_POST['email']}',
                    '{$_POST['cpf']}',
                    '{$novaData}',
                    '{$_POST['tipo']}',
                    '{$_POST['endereco']}',
                    '{$_POST['cep']}',
                    '{$_POST['bairro']}',
                    '{$_POST['numero']}',
                    '{$_POST['cidades']}
                    ')";
//dd($sql);
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('xx','yy') " --> outra forma de fazer as string do SQL 1a PARTE coloca xx e yy
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('{}','{}') " --> Substitui por Chaves
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('{$_POST['nome']}','{$_POST['sigla']}') "  --> ajuste com o campo, porem não funciona to UPPER
            //$sigla = strtoupper($_POST['sigla']); // Criada uma variavel tudo em Maiusculo para usar o código de cima
            //$sql = "INSERT INTO uf (nome,sigla) VALUES('{$_POST['nome']}','{$sigla}') " --> agora usando a variavel, gravamos o texto em UPPER

            $pessoaId = insert_db($sql);
            $mensagemSucesso = '';
            $mensagemErro = '';

            
            if ($pessoaId) {alertSuccess("Sucesso.", "Pessoa {$_POST['primeiro_nome']} cadastrada com sucesso.");}
            else {alertError('Atenção!', "Erro Inesperado");}
            include "cadastro-view.php";
        }
    }
?>