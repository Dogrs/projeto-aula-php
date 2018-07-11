<?php 
//include "home.php";

// Declaração de variaveis
$tituloSite = "Meu site 123";

// Impressao de texto na página
echo '<h1>' . $tituloSite . '</h1>';
// ou
echo("<h2>$tituloSite</h2>");

// Manipulação de arrays
$primeiroArray = array(1,2,3,4,5);
// OU // preferencialmente desta forma
$listaCidades = ['Caxias do Sul', 'Farroupilha', 'Porto Alegre'];

echo $listaCidades[0];
echo "<p>Total de cidades: " . count($listaCidades) . "</p>";

// Adiciona novos valores no final do array
array_push($listaCidades, 'Flores da Cunha');
echo "<p>Total de cidades: " . count($listaCidades) . "</p>";

// Segunda forma para adicionar valores no final do array
$listaCidades[] = 'Veranópolis';
echo "<p>Total de cidades: " . count($listaCidades) . "</p>";

// Exibir conteúdo das variaveis em tela
//print_r($listaCidades);
var_dump($listaCidades);

// recorta o array passando a primeira posição e a quantidade de posições seguintes
$novoArray = array_slice($listaCidades, 1, 2);
echo "<br><br>";

// Retorna o valor da primeira posição do array
array_shift($listaCidades);

// Retorna o valor da última posição do array
array_pop($listaCidades);

// Substitui as posições do primeiro array pelos valores do segundo array
array_replace($listaCidades, ['Veranópolis', 'Outros']);

$listaUfs = [
    'RS' => [
        'Caxias do Sul',
        'Porto Alegre',
    ],
    'SC' => [
        'Florianópolis',
        'Lages',
    ],
];

var_dump($listaUfs);

echo '<h1>Operadores aritméticos</h1>';

// Numeros inteiros
$numA = 10;
$numB = 20;
$resultadoSoma = $numA + $numB;
$resultadoSubtracao = $numA - $numB;
$resultadoMultiplicacao = $numA * $numB; 
$resultadoDivisao = $numB / $numA;
var_dump($resultadoDivisao);

echo "<h2> Numeros FLoats </h2>";
$numC = 10.5;
$numD = 25.2;
$resultadoInteiro = (int) ($numC + $numD);
var_dump($resultadoInteiro);




?>

