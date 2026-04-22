<?php
require 'auth.php';
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Accueil - SocialBook</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* BACKGROUND ANIMATION */
body::before {
    content: "";
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, #4f6df5, transparent 70%);
    top: -100px;
    left: -100px;
    animation: moveBg 8s infinite alternate ease-in-out;
    filter: blur(100px);
}

@keyframes moveBg {
    from { transform: translate(0,0); }
    to { transform: translate(100px,100px); }
}

/* CARD */
.container {
    width: 900px;
    z-index: 2;
}

.card {
    display: flex;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    backdrop-filter: blur(20px);
    overflow: hidden;
    animation: fadeSlide 1s ease forwards;
}

/* ANIMATION ENTRY */
@keyframes fadeSlide {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* LEFT */
.left {
    flex: 1;
    padding: 50px;
    color: white;
    animation: fadeLeft 1.2s ease;
}

@keyframes fadeLeft {
    from { opacity: 0; transform: translateX(-40px); }
    to { opacity: 1; transform: translateX(0); }
}

/* RIGHT */
.right {
    flex: 1;
    padding: 50px;
    text-align: center;
    color: white;
    animation: fadeRight 1.2s ease;
}

@keyframes fadeRight {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}

/* TEXT */
.left h1 {
    font-size: 40px;
    margin-bottom: 20px;
    font-family: italic, serif;
}

.left p {
    opacity: 0.8;
    font-family: italic, serif;
}

/* BUTTONS */
.btn {
    display: block;
    width: 100%;
    padding: 14px;
    border-radius: 30px;
    text-decoration: none;
    margin-top: 15px;
    font-weight: bold;
    transition: 0.3s;
}

/* PRIMARY BUTTON */
.btn-primary {
    background: linear-gradient(135deg, #4f6df5, #6a5af9);
    color: white;
    box-shadow: 0 5px 20px rgba(79, 109, 245, 0.5);
}

/* HOVER EFFECT */
.btn-primary:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 10px 30px rgba(79, 109, 245, 0.8);
}

/* OUTLINE */
.btn-outline {
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    background: transparent;
}

.btn-outline:hover {
    background: rgba(255,255,255,0.1);
    transform: scale(1.03);
}

/* LINK */
.link {
    margin-top: 15px;
    display: inline-block;
    color: #aaa;
    text-decoration: none;
    transition: 0.3s;
}

.link:hover {
    color: white;
}

/* SMALL FLOAT EFFECT */
.btn:active {
    transform: scale(0.95);
}
</style>

</head>
<body>

<div class="container">
    <div class="card">

        <!-- LEFT -->
        <div class="left">
            <h1>SocialBook</h1>
            <p>Connect with friends and the world around you.</p>
        </div>

        <!-- RIGHT -->
        <div class="right">

            <?php if ($user): ?>
                <h2>Bienvenue 👋</h2>
                <p><?= htmlspecialchars($user['email']) ?></p>

                <a href="dashboard.php" class="btn btn-primary">
                    Aller au tableau de bord
                </a>

                <a href="logout.php" class="link">
                    Déconnexion
                </a>

            <?php else: ?>

                <h2>Bienvenue !</h2>
                <p>Rejoignez-nous ou connectez-vous</p>

                <a href="register.php" class="btn btn-primary">
                    Créer un compte
                </a>

                <a href="login.php" class="btn btn-outline">
                    Se connecter
                </a>

            <?php endif; ?>

        </div>

    </div>
</div>

</body>
</html>