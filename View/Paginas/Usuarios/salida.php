<?php
ob_start();

session_unset();
session_destroy();

header("Location: index.php?mensaje=Se cerro la sesion correctamente&status=success");
ob_end_flush();
?>
