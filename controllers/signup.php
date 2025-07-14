<?php
session_start();
require_once '../Connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';

try {
    $sql = new Connect();
    $db = $sql->conn;
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "❌ Impossible de se connecter à la base de données.";
    header('Location: ../views/signup_signin.view.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($_POST['name'])) {
        // Inscription
        $name = $_POST['name'];

        $check = $db->query("SELECT * FROM registration WHERE email = '". $db->real_escape_string($email) ."'");
        if ($check->num_rows > 0) {
            $_SESSION['error'] = '❌ Email déjà inscrit. Essayez de vous connecter.';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert = $db->query("INSERT INTO registration (name, email, password) VALUES ('". $db->real_escape_string($name) ."', '". $db->real_escape_string($email) ."', '$hashedPassword')");

            if ($insert) {
                $_SESSION['success'] = "✅ Inscription réussie. Un email vous a été envoyé.";

                // Email admin
                try {
                    $adminMail = new PHPMailer(true);
                    $adminMail->CharSet = 'UTF-8';
                    $adminMail->isSMTP();
                    $adminMail->Host = 'smtp.gmail.com';
                    $adminMail->SMTPAuth = true;
                    $adminMail->Username = 'saadiaabdilah@gmail.com';
                    $adminMail->Password = 'mawy moxl ugun osia'; // mot de passe app
                    $adminMail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $adminMail->Port = 465;

                    $adminMail->setFrom('saadiaabdilah@gmail.com', 'Form Bot');
                    $adminMail->addAddress('saadiaabdilah@gmail.com', 'Admin');
                    $adminMail->isHTML(true);
                    $adminMail->Subject = 'Nouvelle inscription';
                    $adminMail->Body = "<p><strong>Nom:</strong> $name</p><p><strong>Email:</strong> $email</p>";
                    $adminMail->send();
                } catch (Exception $e) {
                    $_SESSION['error'] = "❌ Erreur email admin : " . $adminMail->ErrorInfo;
                }

                // Email utilisateur
                try {
                    $userMail = new PHPMailer(true);
                    $userMail->CharSet = 'UTF-8';
                    $userMail->isSMTP();
                    $userMail->Host = 'smtp.gmail.com';
                    $userMail->SMTPAuth = true;
                    $userMail->Username = 'saadiaabdilah@gmail.com';
                    $userMail->Password = 'ckpj coqa icnp rpiv'; // mot de passe app
                    $userMail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $userMail->Port = 465;

                    $userMail->setFrom('saadiaabdilah@gmail.com', 'JTR_Shop');
                    $userMail->addAddress($email, $name);
                    $userMail->isHTML(true);
                    $userMail->Subject = '🎉 Félicitations pour votre inscription !';
                    $userMail->Body = "<h2>Bienvenue $name !</h2><p>Merci pour votre inscription sur <strong>JTR_Shop</strong>.</p><p>📧 Email: $email</p>";
                    $userMail->send();
                } catch (Exception $e) {
                    $_SESSION['error'] = "❌ Erreur email utilisateur : " . $userMail->ErrorInfo;
                }

            } else {
                $_SESSION['error'] = "❌ Erreur lors de l'inscription.";
            }
        }
    } else {
        // Connexion
        $check = $db->query("SELECT * FROM registration WHERE email = '". $db->real_escape_string($email) ."'");
        if ($check->num_rows > 0) {
            $user = $check->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['success'] = "✅ Connexion réussie. Bienvenue " . $user['name'] . " !";
            } else {
                $_SESSION['error'] = "❌ Mot de passe incorrect.";
            }
        } else {
            $_SESSION['error'] = "❌ Email non trouvé.";
        }
    }

    header('Location: ../views/signup_signin.view.php');
    exit();
}
?>
