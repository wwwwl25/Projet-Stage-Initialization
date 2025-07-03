<?php
require_once 'Connect.php';
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// PHPMailer includes
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
try{
$sql = new Connect();
$db = $sql->conn;
}catch(mysqli_sql_exception $e){
    echo "Can't connect to the database .";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($_POST['name'])) {
        // INSCRIPTION
        $name = $_POST['name'];

        // Vérifier si l'email est déjà inscrit
        $check = $db->query("SELECT * FROM registration WHERE email = '$email'");
        if ($check->num_rows > 0) {
            echo "<script>alert('❌ Email déjà inscrit. Essayez de vous connecter.');</script>";
        } else {
            // verifier le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // ajouter dans la base de données
            $insert = $db->query("INSERT INTO registration (name, email, password) VALUES ('$name', '$email', '$hashedPassword')");
            if ($insert) {
                echo "<script>alert('✅ Inscription réussie. Un email a été envoyé.');</script>";

                // ---- ENVOI DES EMAILS ----

                // 1. Email à admin entreprise
                $adminMail = new PHPMailer(true);
                try {
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
                    $adminMail->Body = "
                        <p><strong>Nom:</strong> {$name}</p>
                        <p><strong>Email:</strong> {$email}</p>
                    ";
                    $adminMail->AltBody = "Nom: {$name}\nEmail: {$email}";

                    $adminMail->send();

                } catch (Exception $e) {
                    echo "<script>alert('❌ Échec de l\'envoi à l\'admin: {$adminMail->ErrorInfo}');</script>";
                }

                // 2. Email à l'utilisateur
                $userMail = new PHPMailer(true);
                try {
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
                    $userMail->Body = "
                        <h2>Bienvenue {$name} !</h2>
                        <p>Merci pour votre inscription sur <strong>JTR_Shop</strong>.</p>
                        <p>📧 Email: {$email}</p>
                    ";
                    $userMail->AltBody = "Bienvenue {$name}, merci pour votre inscription sur JTR_Shop !";

                    $userMail->send();
                } catch (Exception $e) {
                    echo "<script>alert('❌ Échec de l\'envoi à l\'utilisateur: {$userMail->ErrorInfo}');</script>";
                }
            } else {
                echo "<script>alert('❌ Échec de l\'inscription.');</script>";
            }
        }

    } else {
        // CONNEXION
        $check = $db->query("SELECT * FROM registration WHERE email = '$email'");
        if ($check->num_rows > 0) {
            $user = $check->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                echo "<script>alert('✅ Connexion réussie.');</script>";
            } else {
                echo "<script>alert('❌ Mot de passe incorrect.');</script>";
            }
        } else {
            echo "<script>alert('❌ Email non trouvé.');</script>";
        }
    }
}
?>
