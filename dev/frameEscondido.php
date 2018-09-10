<?php 
header('Content-Type: text/html; charset=ISO-8859-1',true); 
require_once('inc_rastreamento.php');
?>

<html>
<form name="frmTopo">
   <input type='hidden' name='visao' value="">
   <input type='hidden' name='posX' value="">
   <input type='hidden' name='posY' value="">
   <input type='hidden' name='nroRegistrosExibidos' value="">
  

   <!-- Campos LOV -->
   <input type='hidden' name='countLOV' value="<?php echo MAX_ROWS_VIEW ?>">
   <input type='hidden' name='chaveAtualLOV' value="">
   <input type='hidden' name='campoChaveLOV' value="">
   <input type='hidden' name='campoFiltroLOV' value="">
   <input type='hidden' name='valorFiltroLOV' value="">
   <input type='hidden' name='chaveAnteriorLOV' value="">
   <input type='hidden' name='chaveProximaLOV' value="">
   <input type='hidden' name='linkLOV' value=''>
   <input type='hidden' name='camposPesquisaLOV' value="">
   <input type='hidden' name='cabecTabelaLOV' value="">
   <input type='hidden' name='cabecParcTabelaLOV' value="">
   <input type='hidden' name='linkTop2LOV' value="">
   <input type='hidden' name='linhaAtualLOV' value="">
   <input type='hidden' name='selecionadosLOV' value="">
   <input type='hidden' name='campoLOV' value="">
   <input type='hidden' name='layerCampoLOV' value="">
   <input type='hidden' name='nroValoresLOV' value="">
   <input type='hidden' name='valoresAtuaisLOV' value="">

   <!-- Campos Visão -->
   <input type='hidden' name='countVIEW' value="<?php echo MAX_ROWS_VIEW ?>">
   <input type='hidden' name='chaveAtualVIEW' value="">
   <input type='hidden' name='campoChaveVIEW' value="">
   <input type='hidden' name='campoFiltroVIEW' value="">
   <input type='hidden' name='valorFiltroVIEW' value="">
   <input type='hidden' name='chaveAnteriorVIEW' value="">
   <input type='hidden' name='chaveProximaVIEW' value="">
   <input type='hidden' name='linkVIEW' value=''>
   <input type='hidden' name='camposPesquisaVIEW' value="">
   <input type='hidden' name='cabecTabelaVIEW' value="">
   <input type='hidden' name='cabecParcTabelaVIEW' value="">
   <input type='hidden' name='linkTop2VIEW' value="">
   <input type='hidden' name='linhaAtualVIEW' value="">
   <input type='hidden' name='selecionadosVIEW' value="">
   <input type='hidden' name='campoVIEW' value="">
   <input type='hidden' name='layerCampoVIEW' value="">
   <input type='hidden' name='nroValoresVIEW' value="">
   <input type='hidden' name='valoresAtuaisVIEW' value="">

   <!-- Campos Detalhe -->
   <input type='hidden' name='countDET' value="<?php echo MAX_ROWS_VIEW ?>">
   <input type='hidden' name='chaveAtualDET' value="">
   <input type='hidden' name='campoChaveDET' value="">
   <input type='hidden' name='campoFiltroDET' value="">
   <input type='hidden' name='valorFiltroDET' value="">
   <input type='hidden' name='chaveAnteriorDET' value="">
   <input type='hidden' name='chaveProximaDET' value="">
   <input type='hidden' name='linkDET' value=''>
   <input type='hidden' name='camposPesquisaDET' value="">
   <input type='hidden' name='cabecTabelaDET' value="">
   <input type='hidden' name='cabecParcTabelaDET' value="">
   <input type='hidden' name='linkTop2DET' value="">
   <input type='hidden' name='linhaAtualDET' value="">
   <input type='hidden' name='selecionadosDET' value="">
   <input type='hidden' name='campoDET' value="">
   <input type='hidden' name='layerCampoDET' value="">
   <input type='hidden' name='nroValoresDET' value="">
   <input type='hidden' name='valoresAtuaisDET' value="">


</form>
</html>