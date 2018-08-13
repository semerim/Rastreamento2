<?php header('Content-Type: text/html; charset=ISO-8859-1',true);?>

<?php

// destrói sessão
session_start();
session_unset();
session_destroy();

require_once('globais.php');
	
require_once('conexao.php');
require_once('inc_rastreamento.php');

limpaSessao();

?>

<html>
<head>
  <title>. . Login . .</title>
  <link href="css_geral.php" rel='stylesheet' type='text/css'>
  <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />


<script language="javascript"> 

if (window != top)
	window.top.location.href = "logout.php";
			
</script>

</head>

<?php $qs_erro_log = (isset($_REQUEST["erro_log"]) ? $_REQUEST["erro_log"] :  ""); ?>

<body onLoad="window.document.forms[0].usuario.focus()">
  <form action='abre.php' method='post'>
  <center>
<?php
  
  // dumpVar($_SESSION);
  
   if ($qs_erro_log == "1" )
	echo "<h3><center>Usuário ou Senha inválido!</center></h3>";

   if ($qs_erro_log == "2" )
	echo "<h3><center>Sessão expirada!</center></h3>";

   if ($qs_erro_log == "3" )
	echo "<h3><center>Você não está logado!</center></h3>";

   if ($qs_erro_log == "4" )
	echo "<h3><center>Você não está autorizado a acessar esta página.</center></h3>";

   if ($qs_erro_log == "5" )
	echo "<h3><center>Atividade expirada!</center></h3>";

	// echo isset($_SESSION["usuario"]) ? "Usuário: " . $_SESSION["usuario"] : "";
	// echo isset($_SESSION["logado_em"]) ? " em " . $_SESSION["logado_em"] : "";
?>

   <table>
     <tr>
       <td colspan=2><img src=img/login01.jpg></td>
     </tr>
     <tr><td><br></td></tr>
   </table>

  <table>
    <tr>
      <td class=tabela1>Usuário:</td>
      <td class=tabela1><input class=princ name="usuario" type="text" value="" onkeyup='this.value=this.value.toUpperCase(); '></td>
    </tr>
    <tr>
      <td class=tabela1>Senha:</td>
      <td class=tabela1><input name="senha" type="password" value=""></td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
      <td colspan=2><input class=bot type="submit" value='Entrar'></td>
    </tr>
  </table>
  </center>
  <form>
</body>
</html>