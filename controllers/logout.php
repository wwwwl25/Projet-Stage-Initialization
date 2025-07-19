<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        localStorage.clear();
        window.location.href = "../views/signup_signin.view.php";
    </script>
</head>
<body></body>
</html>