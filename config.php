<?php
session_start(); // inicia o $_SESSION

// Define o idioma padrão do PHP para Portugues do Brasil
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
 // define o timezone (fuso horario) padrao do sistema, para o PHP.
date_default_timezone_set('America/Sao_Paulo');

// Inclui arquivo de configuração e metodos de conexão com banco de dados.
include 'db.php';

// Inclui arquivo util.php contendo algumas funções de uso comum do sistema.
include 'utils.php';

/**
 * Arquivo de configuração do projeto
 */

// Ativar exibição de erros no PHP */
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$SITE_URL = 'http://aulaphp.com'//'http://localhost/projeto-aula-php';
//$SITE_URL = 'http://aula.com'
//$SITE_URL = 'http://aulaphp.com/projeto-aula-php/'
?>