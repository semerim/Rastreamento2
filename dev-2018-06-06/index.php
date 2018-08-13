<?

  // destrói sessão
  session_start();
  session_unset();
  session_destroy();

?>

<html>
<head>
  <title>. . Login . .</title>
  <link href="inc/form.css" rel='stylesheet' type='text/css'>
  <META http-equiv="content-type" contents="text/html; charset=UNICODE-1-1-UTF-8" codepage="65001">
</head>

<? $qs_erro_log = $_REQUEST["erro_log"]; ?>

<body onLoad="window.document.forms[0].usuario.focus()">
  <form action='abre.php' method='post'>
  <center>
  <?
   if ( $qs_erro_log != "" )
   {
    echo "<h3><center>Usuário ou Senha inválido !</center></h3>";
   }
  ?>

  <table>
    <tr>
      <td colspan=2>
        <table>
          <tr>
            <td colspan=2><img src=img/logo_actia.jpg></td>
          </tr>
          <tr><td><br></td></tr>
        </table>
      </td>
    </tr>
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