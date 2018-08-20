<?php
include '../config.php';


/**
 * Valida formulario simples
 */


/*function validarFormularioSimples($post) //Modelo simples, foi melhorado
{
    $listaErros = [];
    if (!isset($post['primeiro_nome']) || !$post['primeiro_nome']) {$listaErros['primeiro_nome'] = "Primeiro nome obrigatório.";}
    if (!isset($post['segundo_nome']) || !$post['segundo_nome']) {$listaErros['segundo_nome'] = "Segundo nome obrigatório.";}
    if (!isset($post['email']) || !$post['email']) {$listaErros['email'] = "E-mail obrigatório.";}
    else if ( !validarEmail($post['email']) ) {$listaErros['email'] = "Informe um email válido.";}
    if (!isset($post['cpf']) || !$post['cpf']) {$listaErros['cpf'] = "CPF obrigatório.";}
    else { if (!validarCpf($post['cpf'])){$listaErros['cpf'] = "CPF INVÁLIDO.";}}
    if (!isset($post['data_nascimento']) || !$post['data_nascimento']) {$listaErros['data_nascimento'] = "Data de Nascimento obrigatória.";}
    if (!isset($post['tipo']) || !$post['tipo']) {$listaErros['tipo'] = "Tipo obrigatório.";}
    if (!isset($post['endereco']) || !$post['endereco']) {$listaErros['endereco'] = "Endereço obrigatório.";}
    if (!isset($post['cep']) || !$post['cep']) {$listaErros['cep'] = "CEP obrigatório.";}
    if (!isset($post['bairro']) || !$post['bairro']) {$listaErros['bairro'] = "Bairro obrigatório.";}
    if (!isset($post['numero']) || !$post['numero']) {$listaErros['numero'] = "Número obrigatório.";}
    if (!isset($post['cidades']) || !$post['cidades']) {$listaErros['cidades'] = "Cidade obrigatório.";}
    if (!isset($post['estado']) || !$post['estado']) {$listaErros['estado'] = "Estado obrigatório.";}
    return $listaErros;
}*/

function validarFormulario($post)
{
    // Recebemos uma data_nascimento no $post (no formato dd/mm/AAAA),
    // separamos pelo delimitador '/' e validamos com o checkdate 
    // (retorna false quando a data for invalida e true quando valida)
    //$dataSeparada = explode('/', $post['data_nascimento']);
    //checkdate($dataSeparada[1], $dataSeparada[0], $dataSeparada[2])
    $listaCampos = [
        'primeiro_nome' => "Primeiro nome obrigatório.",
        'segundo_nome' => "Sobrenome obrigatório.",
        'tipo' => "Selecione Professor ou Aluno",
        'email' => "Email obrigatório.",
        'data_nascimento' => "Data nascimento obrigatória.",
        'endereco' => "Endereço obrigatório.",
        'bairro' => "Bairro obrigatório.",
        'numero' => "Número obrigatório.",
        'cep' => "Cep obrigatório.",
        'cidades' => "Cidade obrigatória.",
        'cpf' => "CPF obrigatório.",
        'sexo' => "Sexo obrigatório.",
    ];
    $listaErros = [];
    // Validação dos campos obrigatorios
    foreach($listaCampos as $chaveCampo => $mensagemCampo) 
    {
        if (!isset($post[$chaveCampo]) || !$post[$chaveCampo] ) {$listaErros[$chaveCampo] = $mensagemCampo;}
    }
    if ( !isset($listaErros['cpf']) && $post['cpf'] && !validarCpf($post['cpf'])) {$listaErros['cpf'] = "CPF inválido.";}
    if ( !isset($listaErros['email']) && $post['email'] && !validarEmail($post['email'])) {$listaErros['email'] = "Email inválido.";}
    if ( !isset($listaErros['data_nascimento']) && $post['data_nascimento']) 
    {       
        $dataNascimento = DateTime::createFromFormat('d/m/Y H:i:s', $post['data_nascimento']." 00:00:00");
        if (! $dataNascimento) {$listaErros['data_nascimento'] = "Data nascimento inválida.";}
    }
    return $listaErros;
}

/*
// Manipulando datas com DateTime:
$data = DateTime::createFromFormat('d/m/Y H:i:s', '10/08/1990 00:00:00');
dd($data->format('Y-m-d H:i:s.u'));
*/
if (isset($_POST['data_nascimento']))
{
    $dataNascimentoBanco = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['data_nascimento']." 00:00:00");
}

// Busca todos os UFs (estados) do banco 
$listaUfs        = select_db("SELECT id, nome, sigla FROM uf     ORDER BY nome ASC;");
?><script type="text/javascript">console.log("caraio4");</script><?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {   echo ' **** teste 1 *** ';
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
        $listaErros = validarFormulario($_POST);
        echo "**** teste2 ****";
        //dd($_POST);
        if (isset($_POST['id']) && $_POST['id'] )
        {
            $pessoa = select_one_db("SELECT id, primeiro_nome,segundo_nome,email,cpf,endereco,bairro,numero,cep,cidade_id,data_nascimento,tipo FROM pessoa WHERE id={$_POST['id']}");
        }
        echo "**** teste3 ****";
        //d($_POST);
        //d($listaErros);
        if (count($listaErros) > 0) {include "cadastro-view.php";}
        else if (isset($_POST['id']) && $_POST['id'])
        { echo "**** teste4 ****";
           //d($_POST);
            $cpf_sem_mascara = removerMascaraCpf($_POST['cpf']);
            //$novaDatas = date("Y/m/d",strtotime($_POST['data_nascimento']));
            //d($novaDatas);
            //d($dataNascimentoBanco);
            $dataNascimentoBanco = DateTime::createFromFormat('d/m/Y H:i:s', $_POST['data_nascimento']." 00:00:00");
            d($dataNascimentoBanco);
            //d($_POST);
            //dd($_POST['primeiro_nome']);
            d($dataNascimentoBanco->date);
            //d($_POST['data_nascimento']);
            //dd($novaDatas);
            // Executo o update
            $sql = "UPDATE pessoa SET 
                primeiro_nome   = '{$_POST['primeiro_nome']}', 
                segundo_nome    = '{$_POST['segundo_nome']}',
                email           = '{$_POST['email']}',
                cpf             = '{$cpf_sem_mascara}',
                data_nascimento = $dataNascimentoBanco->date,
                tipo            = {$_POST['tipo']},
                endereco        = '{$_POST['endereco']}',
                cep             = '{$_POST['cep']}',
                bairro          = '{$_POST['bairro']}',
                numero          = '{$_POST['numero']}',
                cidade_id       = {$_POST['cidades']}
                WHERE id = {$_POST['id']};";
                echo "**** teste5 ****";
            //dd($sql);
            $alterado = update_db($sql);
            alertSuccess("Sucesso.", "pessoa {$_POST['primeiro_nome']} alterado com sucesso.");
            dd($alterado);
            redirect("/modulo-pessoa/");
        } 
        else 
        {
            echo "**** teste6 ****";
        dd($_POST);
            //$sql = "INSERT INTO cidade (nome, uf_id) VALUES('".$_POST['nome']."',".$_POST['uf'].");";
            // Executa o insert
            $novaData = date("Y/m/d",strtotime($_POST['data_nascimento']));
            $cpf_sem_mascara = removerMascaraCpf($_POST['cpf']);
            
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
                    '{$cpf_sem_mascara}',
                    '{$novaData}',
                    '{$_POST['tipo']}',
                    '{$_POST['endereco']}',
                    '{$_POST['cep']}',
                    '{$_POST['bairro']}',
                    '{$_POST['numero']}',
                    '{$_POST['cidades']}
                    ')";
//dd($cpf_sem_mascara);
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