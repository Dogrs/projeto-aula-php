<?php
include "../config.php";

    function logar($email, $senha)
    {
        // verifica no banco
        if ($email == 'roberzguerra@gmail.com' && md5($senha) == '81dc9bdb52d04dc20036dbd8313ed055') 
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
        include 'view.php';
    }
    else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $email = $_POST['inputemail'];
        $senha = $_POST['inputsenha'];
        
        if (logar($email, $senha)) 
        {
            redirect('/modulo-pessoa/');
        } 
        else 
        {
            $mensagemErro = "Email ou senha incorretos.";
        }
        
        include 'view.php';
        //    setcookie("login", "email do usuario");
        //    redirect('/cadastro-pessoa/');
    }
?>