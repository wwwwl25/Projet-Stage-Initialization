<?php
session_start();
session_destroy();
header("Location: ../views/signup_signin.view.php");
exit();
?>
