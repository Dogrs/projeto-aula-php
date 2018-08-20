<?php
//echo "<br> Entrou no testePush.php <br>";
include 'utils.php';   // /php/utils - utilidades gerais
include 'db.php';      // /php/utils - utilidades do banco

$sql2 = "SELECT * FROM db_1.TBV01";
$resultado2 = select_db($sql2);
$cont = 0;

//dd($resultado2);
foreach ($resultado2 as $res) {
echo "*************** <br> ";
$cont ++;
if ($res->s1 < $res->mins1 || $res->s1 > $res->maxs1)
    {
        echo "<BR> entrou S1 <BR> {$res->s1}";
        envia_alerta($res->user_name,$res->s1_name,$res->s1,$res->mins1,$res->maxs1, $res->push_id, $res->email);
    }
else if ($res->s2 < $res->mins2 || $res-> s2 > $res->maxs2)
    {
        echo "<BR> entrou S2 <BR> {$res->s2}";
        envia_alerta($res->user_name,$res->s2_name,$res->s2,$res->mins2,$res->maxs2, $res->push_id, $res->email);
    }
else if ($res->s3 < $res->mins3 || $res-> s3 > $res->maxs3)
    {
        echo "<BR> entrou S3 <BR> {$res->s3}";
        envia_alerta($res->user_name,$res->s3_name,$res->s3,$res->mins3,$res->maxs3, $res->push_id, $res->email);
    }
else if ($res->s4 < $res->mins4 || $res-> s4 > $res->maxs4)
    {
        echo "<BR> entrou S4 <BR> {$res->s4}";
        envia_alerta($res->user_name,$res->s4_name,$res->s4,$res->mins4,$res->maxs4, $res->push_id, $res->email);
    }    
else if ($res->s5 < $res->mins5 || $res-> s5 > $res->maxs5)
    {
        echo "<BR> entrou S5 <BR> {$res->s5}";
        envia_alerta($res->user_name,$res->s5_name,$res->s5,$res->mins5,$res->maxs5, $res->push_id, $res->email);
    }

    echo "$cont OK <BR>";    
    //echo "$res->user_name - OK <br>";

}


function envia_alerta($usuario, $nome_sensor, $valor_sensor, $valor_min, $valor_max, $push_id, $push_email)
{
    echo "<br>*************** <br> ";
    echo " Usuário - $usuario <br>";
    echo " Minima $nome_sensor -  $valor_min <br>";
    echo " Valor  $nome_sensor -  $valor_sensor <br>";
    echo " Máxima $nome_sensor -  $valor_max <br>";
    //echo "Push id - $push_id - $push_email <br> ";
    echo "*************** <br> ";

    require 'PushBullet.class.php';
    try {    
        $p = new PushBullet($push_id);
        //$p->pushNote('luiz.motter@gmail.com', 'Teste', 'Tudo ok, sensores de nivel ok e temperatura em 10o');
        $p->pushNote($push_email, '*** ALERTA ***', "{$usuario} - Sensor {$nome_sensor} está em: {$valor_sensor}, MIN: {$valor_min} MAX: {$valor_max}");
      echo (" OK ");
    } catch (PushBulletException $e) {die($e->getMessage());}
}

?>