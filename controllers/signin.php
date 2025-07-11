<?php
require_once 'Connect.php';
try{
    $sql = new Connect();
    $db = $sql->conn;
}catch(mysqli_sql_exception $e){
    echo "Can't connect to the database .";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
//$2y$10$RWTm5lUFPW7VxiIWKjAvoexlwpNzCrXaK
    function emailValidation($email){
        // EMAIL VALIDAION
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: signup_signin.view.php?email_error=Invalid Email !");
            return false;
        }else if(empty($email)){
            header("Location: signup_signin.view.php?email_error=Please enter an email !");
            return false;
        }
        else{
          return true;
        }

    }
    function passValidation($password){
        if(empty($password)){
            header("Location: signup_signin.view.php?password_error=Please enter a password !");
            return false;
        }else{
            return true;
        }
    }
    function signin($email, $password,$db){
        $search_query = "SELECT email, password FROM registration WHERE email='$email'";

        $result = mysqli_query($db, $search_query);
        $user = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) === 1){
            if(password_verify($password, $user['password'])) {
                header("Location: user.php");
                exit();
            }else{
                header("Location: signup_signin.view.php?password_error=Your password is incorrect !");
                exit();
            }
        }else{
            header("Location: signup_signin.view.php?signin_error=User doesn't exist. Register an account !");
            exit();
        }
    }
    if(emailValidation($email) && passValidation($password)){
        signin($email, $password, $db);
    }
}