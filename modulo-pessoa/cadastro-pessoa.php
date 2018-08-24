<?php
include '../config.php';
include "pessoa.php";
/*
// Manipulando datas com DateTime:
$data = DateTime::createFromFormat('d/m/Y H:i:s', '10/08/1990 00:00:00');
dd($data->format('Y-m-d H:i:s.u'));
*/
/**
 * Valida formulario simples
 */
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
        'cidade' => "Cidade obrigatória.",
        'cpf' => "CPF obrigatório.",
        'sexo' => "Sexo obrigatório.",
    ];
    $listaErros = [];
    // Validação dos campos obrigatorios
    foreach($listaCampos as $chaveCampo => $mensagemCampo) {
        if (!isset($post[$chaveCampo]) || !$post[$chaveCampo] ) {
            $listaErros[$chaveCampo] = $mensagemCampo;
        }
    }
    if ( !isset($listaErros['cpf']) && $post['cpf'] && !validarCpf($post['cpf'])) {
        $listaErros['cpf'] = "CPF inválido.";
    } else if ($post['cpf']) {
        $cpfSemMascara = removerMascaraCpf($post['cpf']);
        $where = '';
        if (isset($post['id']) && $post['id']) {
            $where = "AND pessoa.id<>{$post['id']}";
        }
        $resultado = select_one_db("
            SELECT 
                COUNT(id) AS count 
            FROM 
                pessoa 
            WHERE 
                cpf='{$cpfSemMascara}'
                $where;
            ");
        if ($resultado->count > 0) {
            $listaErros['cpf'] = "CPF já cadastrado.";
        }
    }
    if ( !isset($listaErros['email']) && $post['email'] && !validarEmail($post['email'])) {
        $listaErros['email'] = "Email inválido.";
    } else if ($post['email']) {
        
        $where = '';
        if (isset($post['id']) && $post['id']) {
            $where = " AND id <> {$post['id']}";
        }
        $resultado = select_one_db("
            SELECT 
                COUNT(id) AS count 
            FROM 
                pessoa 
            WHERE 
                email='{$post['email']}'
                $where
            ;");
        if ($resultado->count > 0) {
            $listaErros['email'] = "Email já cadastrado.";
        }
    }
    if ( !isset($listaErros['data_nascimento']) && $post['data_nascimento']) {
        $dataNascimento = DateTime::createFromFormat('d/m/Y H:i:s', $post['data_nascimento']." 00:00:00");
        if (! $dataNascimento) {
            $listaErros['data_nascimento'] = "Data nascimento inválida.";
        }
    }
    return $listaErros;
}
$listaUfs = select_db("SELECT id, nome, sigla FROM uf ORDER BY nome ASC;");
$pessoa = new Pessoa();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaErros = [];
    if (isset($_GET['edit']) && $_GET['edit'] == 1
        && isset($_GET['id']) && $_GET['id']) {
            // Busca a pessoa do banco de dados
            $pessoaBd = select_one_db("
                SELECT 
                    pessoa.id AS id,
                    pessoa.primeiro_nome AS primeiro_nome,
                    pessoa.segundo_nome AS segundo_nome,
                    pessoa.email AS email,
                    pessoa.cpf AS cpf,
                    pessoa.data_nascimento AS data_nascimento,
                    pessoa.endereco AS endereco,
                    pessoa.bairro AS bairro,
                    pessoa.numero AS numero,
                    pessoa.cep AS cep,
                    pessoa.tipo AS tipo,
                    pessoa.sexo AS sexo,
                    pessoa.cidade_id AS cidade_id,
                    uf.id AS uf_id
                FROM pessoa 
                    INNER JOIN cidade ON(cidade.id=pessoa.cidade_id) 
                    INNER JOIN uf ON(uf.id=cidade.uf_id)
                WHERE 
                    pessoa.id = {$_GET['id']};
            ");
            $pessoa = new Pessoa($pessoaBd);
            
        }
    include "cadastro-view.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $pessoa->setPost($_POST);
    // Utilizem o metodo validarFormularioSimples OU validarFormularioAvancado
    $listaErros = validarFormulario($_POST);
    //$listaErros = validarFormularioAvancado($_POST, ['nome', 'email']);
    if (isset($_POST['id']) && $_POST['id'] )  {
        $uf = select_one_db("SELECT id, nome, sigla FROM uf WHERE id = {$_POST['id']}");
    }
    if (count($listaErros) > 0) {
        include "cadastro-view.php";
    } else if (isset($_POST['id']) && $_POST['id']) {
        $dataNascimentoBanco = $pessoa->data_nascimento->format('Y-m-d') . ' 00:00:00';
        // Executo o update
        $sql = "UPDATE pessoa
            SET
                primeiro_nome = '{$pessoa->primeiro_nome}',
                segundo_nome = '{$pessoa->segundo_nome}',
                email = '{$pessoa->email}',
                cpf = '{$pessoa->cpf}',
                data_nascimento = '{$dataNascimentoBanco}',
                tipo = {$pessoa->tipo},
                endereco = '{$pessoa->endereco}',
                cep = '{$pessoa->cep}',
                bairro = '{$pessoa->bairro}',
                numero = '{$pessoa->numero}',
                cidade_id = {$pessoa->cidade_id},
                sexo = '{$pessoa->sexo}'
            WHERE id = {$pessoa->id};
        ";
        $alterado = update_db($sql);
        alertSuccess("Sucesso.", "Pessoa {$pessoa->getNomeCompleto()} alterada com sucesso.");
        
        redirect("/modulo-pessoa/");
        
    } else {
        //$post = formatarPost($_POST);
        $dataNascimentoBanco = $pessoa->data_nascimento->format('Y-m-d') . ' 00:00:00';
        $sql = "INSERT INTO pessoa (
            primeiro_nome,
            segundo_nome,
            email,
            cpf,
            data_nascimento,
            tipo,
            endereco,
            cep,
            bairro,
            numero,
            cidade_id,
            sexo
        ) VALUES (
            '{$pessoa->primeiro_nome}',
            '{$pessoa->segundo_nome}',
            '{$pessoa->email}',
            '{$pessoa->cpf}',
            '{$dataNascimentoBanco}',
            {$pessoa->tipo},
            '{$pessoa->endereco}',
            '{$pessoa->cep}',
            '{$pessoa->bairro}',
            '{$pessoa->numero}',
            {$pessoa->cidade_id},
            '{$pessoa->sexo}'
        );";
        
        $pessoaId = insert_db($sql);
        if ($pessoaId) {
            alertSuccess("Sucesso.", "Pessoa {$_POST['primeiro_nome']} acadastrado com sucesso.");
        } else {
            alertError("Erro.", "Erro ao cadastrar pessoa.");
        }
        include "cadastro-view.php";
    }
}
?>