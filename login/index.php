<?php
    include "../config.php";

    function logar($email, $senha)
    {
        // senha md5 1234: 81dc9bdb52d04dc20036dbd8313ed055
        // verifica no banco
        // Quando for salvar a senha, gere o hash md5 adicionando mais strings na senha, exemplo: md5('CursoFlexoo'. $email . $senha)
        $hashSenha = md5($senha);
        $usuario = select_one_db("SELECT senha FROM usuario WHERE email = '{$email}';"); 
        
        if ($usuario && $usuario->senha == $hashSenha)
        {
            // parametros:
            // 1 - nome do cookie
            // 2 - valor
            // 3 - tempo de validade time()+60*60*24*30 == 30 dias
            // 4 - Caminho "/" para valer em todo o site
            // 5 - nome do dominio
            setcookie("login", $email, time()+60*60*24*30, "/", $SITE_URL);
            return true;
        }
        return false;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        // Abre a pagina de login
        include 'view.php';
    }
    else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $email = $_POST['inputemail'];
        $senha = $_POST['inputsenha'];
        
        if ($email && $senha && logar($email, $senha)) 
        {
            redirect('/modulo-pessoa/');
        }
        else
        {
            $mensagemErro = "Email ou senha incorretos.";
        }
        include 'view.php';
    }
?>