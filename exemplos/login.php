tratar as informações inseridas na página de login e verificar se o usuário inseriu as informações corretas, após direciona
<?php 
  $login = $_POST['login'];
  $entrar = $_POST['entrar'];
  $senha = md5($_POST['senha']);
  $connect = mysql_connect('nome_do_servidor','nome_de_usuario','senha');
  $db = mysql_select_db('nome_do_banco_de_dados');
    if (isset($entrar)) {
             
      $verifica = mysql_query("SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
        if (mysql_num_rows($verifica)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
          die();
        }else{
          setcookie("login",$login);
          header("Location:index.php");
        }
    }
?>


página index.php

<?php
  $login_cookie = $_COOKIE['login'];
    if(isset($login_cookie)){
      echo"Bem-Vindo, $login_cookie <br>";
      echo"Essas informações <font color='red'>PODEM</font> ser acessadas por você";
    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
      echo"<br><a href='login.html'>Faça Login</a> Para ler o conteúdo";
    }
?>

Listagem 6. index.php

Pronto, agora você já tem um simples sistema de cadastro e login para usar no seu projeto, lembrando que isso é apenas o básico e podem ser utilizadas várias outras técnicas para validação de login e segurança.

Então isso pessoal, por hoje ficamos por aqui e até a próxima. ;)