<?php

session_start();
require_once('globais.php');
require_once('inc_rastreamento.php');

if (isActivityExpired() or isLoginSessionExpired())
	echo "0";
else
	echo "1";


?>