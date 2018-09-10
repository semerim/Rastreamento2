<?php 
   session_start();

   require_once('globais.php');

   require_once('conexao.php');
   require_once('inc_rastreamento.php');

   // ---------- VERIFICA AUTENTICAÇÃO ----------

   verifyLogin (0);


// ---------- REQUESTS ----------

   $qs_cmp_chave    			= isset($_REQUEST["ctl_campo_chave"]) ? $_REQUEST["ctl_campo_chave"] : "";
   $qs_vlr_chave    			= isset($_REQUEST["ctl_valor_chave"]) ? $_REQUEST["ctl_valor_chave"] : "";
   $qs_vlr_chave_mestre    		= isset($_REQUEST["ctl_valor_chave_mestre"]) ? $_REQUEST["ctl_valor_chave_mestre"] : "";
   $qs_operacao     			= isset($_REQUEST["ctl_operacao"]) ? $_REQUEST["ctl_operacao"] : "";
   $qs_sequence     			= isset($_REQUEST["ctl_sequence"]) ? $_REQUEST["ctl_sequence"] : "";
   $qs_redirect     			= isset($_REQUEST["ctl_redirect"]) ? $_REQUEST["ctl_redirect"] : "";
   $qs_tabela       			= isset($_REQUEST["ctl_tabela"]) ? $_REQUEST["ctl_tabela"] : "";
   $qs_force_insert 			= isset($_REQUEST["ctl_force_insert"]) ? $_REQUEST["ctl_force_insert"] : "";


// ---------- BLOCO PRINCIPAL ----------

   $conexao = getConexao ();

   // coloca os campos em arrays
   $i = 0;
   while (list ($key, $val) = each ($_REQUEST)) {
      // se é um parâmetro campo
      if (substr ($key, 0, 6) == "grava_") {
         $key = substr ($key, 6);
         $array_campos [$i]  = $key;
         $tipo = strtoupper(getColumnType ($qs_tabela, $key));
		 $val = utf8_decode($val);
		 
         $gen_tipo = strtoupper(getGenericType ($tipo));
         // echo "Campo: " . $key . " (TIPO: " . $tipo . " - " . $gen_tipo . ")<br>";

         if ($val == "") {
            $val = "NULL";
         }
         else {
            if (substr ($tipo, 0, 9) == "TIMESTAMP") {
               // $val = "to_timestamp ('" . $val . " 00:00:00', 'dd/mm/yyyy HH24:MI:SS')";
			   $val = "timestamp ('" . $val . " 00:00:00')";
            }
            else {
               // se é data ou texto recebe ASPAS
               if (substr ($tipo, 0, 4) == "DATE") {
                  // $val = "to_date ('" . $val . "', 'dd/mm/yyyy')";
				  $val = "str_to_date ('" . $val . "', '%d/%m/%Y')";
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

	// ----------------------------------------------------------------------------------------------
   
	switch ($qs_operacao) {
		case "INSERT":
			if ($qs_sequence != "") {
				// $val_seq = executeSequence( $conexao, $qs_sequence );
				$val_seq = nextValSeqDB ($qs_tabela);
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
			
			break;
		
		case "UPDATE":	
		// com chave - significa um update
			$lista = "";
			for ( $i=0; $i<count($array_campos); $i++ ) {
				$lista .= "," . $array_campos[$i] . "=" . $array_valores[$i] . "";
			}
			$lista = substr($lista, 1);

			$query = "update " . $qs_tabela . " set " . $lista . " where " . $qs_cmp_chave . "=" . $qs_vlr_chave;
			
			break;
		
		case "DELETE":
			$query = "delete from " . $qs_tabela . " where " . $qs_cmp_chave . "=" . $qs_vlr_chave;
		
			break;
	}

	// dumpVar($query);
	// echo "rodando 1";
	simpleSelectPDO ($query);
	// echo "rodando 2";
	insertLog ($qs_tabela, $qs_vlr_chave . "^" . $qs_vlr_chave_mestre, $qs_operacao, "");
	// dumpVar($qs_redirect);
	//  echo "<script>alert ('" . $qs_tabela . " gravado com sucesso!')</script>";
	redirect ($qs_redirect);

?> 