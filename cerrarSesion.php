<?php
	setcookie('autenticado', 'SI', time() - 1000);
    setCookie('uid', '', time() - 1000);
    header ("Location: index.php");
?>