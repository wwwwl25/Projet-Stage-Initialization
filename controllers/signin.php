<?php
require_once '../Connect.php';
session_start();

try {
    $sql = new Connect();
    $db = $sql->conn;
} catch (mysqli_sql_exception $e) {
    echo "Can't connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    function emailValidation($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../views/signup_signin.view.php?email_error=Invalid Email !");
            return false;
        } else if (empty($email)) {
            header("Location: ../views/signup_signin.view.php?email_error=Please enter an email !");
            return false;
        }
        return true;
    }

    function passValidation($password) {
        if (empty($password)) {
            header("Location: ../views/signup_signin.view.php?password_error=Please enter a password !");
            return false;
        }
        return true;
    }

    function signin($email, $password, $db) {
        // ✅ ADMIN HARDCODED
        if ($email === 'admin@gmail.com' && $password === 'admin123') {
            $_SESSION['user_email'] = 'admin@gmail.com';
            $_SESSION['user_name'] = 'Administrator';
            header("Location: ../views/utilities/admin.php");
            exit();
        }

        // 👤 NORMAL USER
        $query = "SELECT name, email, password FROM registration WHERE email = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];
                header("Location: ../views/user1.php");
                exit();
            } else {
                header("Location: ../views/signup_signin.view.php?password_error=Your password is incorrect !");
                exit();
            }
        } else {
            header("Location: ../views/signup_signin.view.php?signin_error=User doesn't exist. Register an account !");
            exit();
        }
    }

    if (emailValidation($email) && passValidation($password)) {
        signin($email, $password, $db);
    }
}
?>
