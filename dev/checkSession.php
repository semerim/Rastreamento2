<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script type="text/javascript" src="checkLoginSession.js"></script>
<?php require_once('globais.php'); ?>
<script type="text/javascript">
    setTimeout(function() { window.location.href = "logout.php"; }, 1000 * 60 * <?php echo LOGIN_TIMEOUT; ?>);
</script>