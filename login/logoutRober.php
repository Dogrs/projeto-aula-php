<?php
include '../config.php';

// Remove todos os cookies do site
function removerCookies()
{
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);

        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    } 
}


unset($_SESSION);
removerCookies();
redirect('/login/');
?>