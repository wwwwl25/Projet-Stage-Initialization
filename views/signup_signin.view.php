<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/signup.css">
</head>
<body>
    <?php require 'utilities/nav-bar.php';?>
    <div class="wrapper">
        <img src="../images/img.png" alt="leaves">
        <h2 class="text-right">Welcome</h2>
        <div class="form-wrapper login">
            <form action="../controllers/signin.php" method="post">
                <h2>Login</h2>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" placeholder="Email"  name="email" required>
                    <p style="color:darkred;margin-top:10px;"><?php echo isset($_GET['email_error']) ? $_GET['email_error'] : '';?></p>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" placeholder="Password"   name="password" required>
                    <p style="color:darkred;margin-top:10px;"><?php echo isset($_GET['password_error']) ? $_GET['password_error'] : '';?></p>

                </div>
<!--                <div class="forgot-pass">-->
<!---->
<!--                    <a href="#">Forgot Password?</a>-->
<!--                </div>-->

                <button type="submit">Login</button>
                <p style="color:darkred;margin-top:10px;"><?php echo isset($_GET['signin_error']) ? $_GET['signin_error'] : '';?></p>


                <div class="sign-link">
                    <p>Don't have an account? <a href="#" onclick="registerActive()">Register</a></p>
                </div>

            </form>
        </div>
        <div class="form-wrapper register">
            <form action="../controllers/signup.php" method="post">
                <h2>Registration</h2>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" placeholder="Full Name"  name="name" required>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" placeholder="Password"  name="password" required>
                </div>
                <button type="submit">Register</button>
                <div class="sign-link">
                    <p>Already have an account? <a href="#" onclick="loginActive()">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../scripts/signup.js"></script>

</body>
</html>