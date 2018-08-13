<html>
<head>

<?php require_once('globais.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS.php'); ?>
<?php require_once (RAIZ_INC . 'funcoesJS_validation.php'); ?>
<?php // require_once (RAIZ_INC . 'checkSession.php'); ?>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">

<link href="css_geral.php" rel='stylesheet' type='text/css'>

<script>
function autoRefresh(interval) {
	setInterval("location.reload(true);",interval*1000);
}
</script>

<title>..:.. Login Status ..:..</title>
</head>

<body onload="JavaScript:autoRefresh(10);">

<?php

// echo phpversion();

session_start();

require_once(RAIZ_INC . 'conexao.php');
require_once(RAIZ_INC . 'inc_rastreamento.php');

require_once('globais.php');
// dumpVar($_SESSION);
// timeout em minutos - calcular em segundos
$timeoutLogin = LOGIN_TIMEOUT * 60;
$timeoutActivity = ACTIVITY_TIMEOUT * 60;

$ultima_atividade = isset($_SESSION['ultima_atividade']) ? $_SESSION['ultima_atividade'] : "0";
$ultima_atividade_date = date('Y-m-d H:i:s', timeAdjust($ultima_atividade));

$logado_em = isset($_SESSION['logado_em']) ? $_SESSION['logado_em'] : "0";
$logado_em_date = date('Y-m-d H:i:s', timeAdjust($logado_em));

$agora = now();
$agora_date = date('Y-m-d H:i:s', timeAdjust($agora));
// $agora_date = date('Y-m-d H:i:s', $agora);

$usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : "";
$nome = isset($_SESSION["nome"]) ? $_SESSION["nome"] : "";
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
$nivel = isset($_SESSION["nivel"]) ? $_SESSION["nivel"] : "";

$remainingLoginTime = remainingLoginTime();
$formatLoginTime = gmdate("H:i:s", $remainingLoginTime);
$currentLoginTime = $timeoutLogin - $remainingLoginTime;
$formatCurrentLoginTime = gmdate("H:i:s", $currentLoginTime);

$remainingActivityTime = remainingActivityTime();
$formatActivityTime = gmdate("H:i:s", $remainingActivityTime);
$currentActivityTime = $timeoutActivity - $remainingActivityTime;
$formatCurrentActivityTime = gmdate("H:i:s", $currentActivityTime);


$tabela =  "<table width=>\n";
$tabela .= "<tr>\n<td width=40%>Usuário</td><td>$usuario</td></tr>\n";

$tabela .= "</table>\n";
/*
echo $tabela;

echo "<pre>";

echo "<b>";
echo "Usuário....................: $usuario<br>";
echo "Nome.......................: $nome<br>";
echo "Email......................: $email<br>";
echo "Nível......................: $nivel<br>";
echo "</b><br>";

echo "Logado em..................: $logado_em_date ($logado_em)<br>";
echo "Última atividade...........: $ultima_atividade_date ($ultima_atividade)<br>";
echo "Agora......................: $agora_date ($agora)<br>";
echo "Timeout Login..............: $timeoutLogin" . "s (" . LOGIN_TIMEOUT . "min)<br>";
echo "Tempo de Login.............: " . $currentLoginTime . "s ($formatCurrentLoginTime)<br>";
echo "Tempo restante de Login....: " . $remainingLoginTime . "s ($formatLoginTime)<br>";
echo "Login expirado.............: " . (isLoginSessionExpired() ? "S" : "N") . "<br>";
echo "Timeout Activity...........: $timeoutActivity" . "s (" . ACTIVITY_TIMEOUT . "min)<br>";
echo "Tempo de Activity..........: " . $currentActivityTime . "s ($formatCurrentActivityTime)<br>";
echo "Tempo restante de Atividade: " . $remainingActivityTime . "s ($formatActivityTime)<br>";
echo "Atividade expirada.........: " . (isActivityExpired() ? "S" : "N") . "<br>";
echo "</pre>";
*/
?>

<table width="530" height="30"  border="0" align="left" bordercolor="#CCCCCC">
  <tr align="center" valign="middle" bgcolor="#D7ECFF" class="tabelaFx2">
    <td height="100%" colspan="2" class="cabec_tabela1">LOGIN STATUS</td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1"><b>Usuário:</b></td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <b><?php echo $usuario ?></b>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1"><b>Nome:</b></td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <b><?php echo $nome ?></b>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1"><b>Email:</b></td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <b><?php echo $email ?></b>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1"><b>Nível:</b></td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <b><?php echo $nivel ?></b>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Logado em:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo "$logado_em_date ($logado_em)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Última atividade:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo "$ultima_atividade_date ($ultima_atividade)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Agora:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo "$agora_date ($agora)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Timeout Login:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo "$timeoutLogin" . "s (" . LOGIN_TIMEOUT . "min)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Tempo de Login:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo $currentLoginTime . "s ($formatCurrentLoginTime)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Tempo Restante de Login:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo $remainingLoginTime . "s ($formatLoginTime)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Login Expirado:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo (isLoginSessionExpired() ? "S" : "N") ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Timeout Activity:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo "$timeoutActivity" . "s (" . ACTIVITY_TIMEOUT . "min)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Tempo de Activity:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo $currentActivityTime . "s ($formatCurrentActivityTime)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Tempo Restante de Activity:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo $remainingActivityTime . "s ($formatActivityTime)" ?>
    </td>
  </tr>
  <tr>
    <td width=40% align="right" class="tabelaFx1">Activity Expirado:</td>
    <td align="left" valign="middle" class="tabelaFx2">
    	 <?php echo (isActivityExpired() ? "S" : "N") ?>
    </td>
  </tr>

</table>




</html>
