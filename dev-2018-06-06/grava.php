<?
   session_start();

   include('globais.php');

   include(RAIZ_INC . 'conexao.php');
   include(RAIZ_INC . 'inc_west.php');

   // ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);


// ---------- REQUESTS ----------

   $qs_cmp_chave    			= $_REQUEST["ctl_campo_chave"];
   $qs_vlr_chave    			= $_REQUEST["ctl_valor_chave"];
   $qs_vlr_chave_mestre    = $_REQUEST["ctl_valor_chave_mestre"];
   $qs_operacao     			= $_REQUEST["ctl_operacao"];
   $qs_sequence     			= $_REQUEST["ctl_sequence"];
   $qs_redirect     			= $_REQUEST["ctl_redirect"];
   $qs_tabela       			= $_REQUEST["ctl_tabela"];
   $qs_force_insert 			= $_REQUEST["ctl_force_insert"];


// ---------- BLOCO PRINCIPAL ----------

   $conexao = getConexao ();

   // coloca os campos em arrays
   $i = 0;
   while (list ($key, $val) = each ($_REQUEST)) {
      // se é um parâmetro campo
      if (substr ($key, 0, 6) == "grava_") {
         $key = substr ($key, 6);
         $array_campos [$i]  = $key;
         $tipo = getColumnType ($conexao, $qs_tabela, $key);

         $gen_tipo = getGenericType ($tipo);
//          echo "Campo: " . $key . " (TIPO: " . $tipo . " - " . $gen_tipo . "), ";

         if ($val == "") {
            $val = "NULL";
         }
         else {
            if (substr ($tipo, 0, 9) == "TIMESTAMP") {
               $val = "to_timestamp ('" . $val . " 00:00:00', 'dd/mm/yyyy HH24:MI:SS')";
            }
            else {
               // se é data ou texto recebe ASPAS
               if (substr ($tipo, 0, 4) == "DATE") {
                  $val = "to_date ('" . $val . "', 'dd/mm/yyyy')";
               }
               else {
                  if (($gen_tipo == "TEXT" || $gen_tipo == "DATETIME") && strtolower($val) != "current_timestamp") {
                     $val = "'" . $val . "'";
                  }
               }
            }
         }

         $array_valores[$i] = $val;
         $i++;
      }
   }

   // ---------------------

   if ($qs_operacao == "INSERT") {
      if ($qs_sequence != "") {
         $val_seq = executeSequence( $conexao, $qs_sequence );
      }
      else {
         $val_seq = $qs_vlr_chave;
      }

      $campos = $qs_cmp_chave;
      $qs_vlr_chave = $val_seq;

      for ( $i=0; $i<count($array_campos); $i++ ) {
         $campos .= "," . $array_campos[$i];
      }
      $valores = $val_seq;
      for ( $i=0; $i<count($array_valores); $i++ ) {
         $valores .= "," . $array_valores[$i];
      }
      $query = "insert into " . $qs_tabela . " (" . $campos . ") values (" . $valores . ")";
      $qs_redirect .= "&valorChave=" . $val_seq;
//      echo $query;
   }
   // com chave - significa um update
   else {
      $lista = "";
      for ( $i=0; $i<count($array_campos); $i++ ) {
         $lista .= "," . $array_campos[$i] . "=" . $array_valores[$i];
      }
      $lista = substr($lista, 1);

      $query = "update " . $qs_tabela . " set " . $lista . " where " . $qs_cmp_chave . "=" . $qs_vlr_chave;
   }

   simpleSelect ($conexao, $query);
   insertLog ($qs_tabela, $qs_vlr_chave . "^" . $qs_vlr_chave_mestre, $qs_operacao, "");
//   echo $qs_redirect;
//  echo "<script>alert ('" . $qs_tabela . " gravado com sucesso!')</script>";
   redirect ($qs_redirect);

?>