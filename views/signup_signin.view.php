<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in</title>
    <link rel="stylesheet" href="../styles/nav-bar.css" />
    <link rel="stylesheet" href="../styles/signup.css" />
    <link rel="stylesheet" href="../styles/footer.css" />
</head>
<body>
    <?php require 'utilities/nav-bar.php'; ?>

    <main>
        <div class="wrapper">
            <h2 class="text-right">Welcome</h2>

            <!-- Messages -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="message error" id="msg-box">
                    <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php elseif (isset($_SESSION['success'])): ?>
                <div class="success-message" id="msg-box">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path d="M16 2a2 2 0 11-4 0 2 2 0 014 0zM7.03 10.58l-2.28-2.28a.75.75 0 10-1.06 1.06l2.8 2.79a.75.75 0 001.06 0l5.1-5.1a.75.75 0 10-1.06-1.06L7.03 10.58z"/>
                    </svg>
                    <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <div class="form-wrapper login">
                <form action="../controllers/signup.php" method="post">
                    <h2>Login</h2>

                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>

                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>

                    <button type="submit">Login</button>

                    <div class="sign-link">
                        <p>Don't have an account? <a href="#" onclick="registerActive()">Register</a></p>
                    </div>
                </form>
            </div>

            <!-- Register Form -->
            <div class="form-wrapper register">
                <form action="../controllers/signup.php" method="post">
                    <h2>Registration</h2>

                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="name" placeholder="Full Name" required />
                    </div>

                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>

                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>

                    <button type="submit">Register</button>

                    <div class="sign-link">
                        <p>Already have an account? <a href="#" onclick="loginActive()">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require_once "utilities/footer.php"; ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../scripts/signup.js"></script>
</body>
</html>
