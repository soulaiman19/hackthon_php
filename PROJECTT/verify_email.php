<?php
require 'auth.php';

$message = '';
$error = '';

$email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
$code = $_GET['code'] ?? '';

if (!$email || !$code) {
    $error = 'Lien de vérification invalide ou incomplet.';
} else {
    if (verifyUserEmail($email, $code)) {
        $message = '✓ Votre adresse email a bien été vérifiée. Vous pouvez maintenant vous connecter.';
    } else {
        $error = 'Lien de vérification incorrect, expiré ou le compte n\'existe pas.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Vérification Email</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    overflow: hidden;
}

/* BACKGROUND */
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
    to { transform: translate(120px,120px); }
}

/* CARD */
.container {
    width: 420px;
    padding: 30px 20px 25px;
    border-radius: 20px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(20px);
    text-align: center;
    color: white;
    z-index: 2;
    animation: fadeSlide 1s ease;
    position: relative;
}

.container::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 140px;
    background: linear-gradient(135deg, #4f6df5, #6a5af9);
    top: 0;
    left: 0;
    border-bottom-left-radius: 100px;
    border-bottom-right-radius: 100px;
}

.container::after {
    content: "✉";
    position: absolute;
    top: 80px;
    left: 50%;
    transform: translateX(-50%);
    width: 70px;
    height: 70px;
    background: white;
    color: #6a5af9;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    margin-top: 140px;
    margin-bottom: 20px;
}

.message {
    background: rgba(34,197,94,0.2);
    color: #bbf7d0;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
}

.error {
    background: rgba(239,68,68,0.2);
    color: #fecaca;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
}

/* BUTTON BASE */
a {
    display: block;
    width: 85%;
    margin: 12px auto;
    padding: 14px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

/* LOGIN BUTTON */
.message ~ p a {
    background: linear-gradient(135deg, #4f6df5, #6a5af9);
    color: white;
    box-shadow: 0 5px 20px rgba(79,109,245,0.5);
}

/* REGISTER BUTTON */
.error ~ p a {
    border: 2px solid rgba(255,255,255,0.4);
    color: white;
    background: transparent;
}

/* HOVER EFFECT */
a[href="index.php"] {
    background: transparent !important;
    border: 2px solid rgba(255,255,255,0.6);
    color: white;
    box-shadow: none;
}

/* HOVER */
a:hover {
    transform: scale(1.05);
}

hr {
    border: none;
    height: 1px;
    background: rgba(255,255,255,0.2);
    margin: 15px 0;
}
</style>

</head>
<body>

<div class="container">
    <h1>Vérification de l'email</h1>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
        <p><a href="login.php">→ Se connecter maintenant</a></p>
    <?php else: ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
        <p><a href="register.php">← Retour à l'inscription</a></p>
    <?php endif; ?>

    <hr>
    <p><a href="index.php">Retour à l'accueil</a></p>
</div>

</body>
</html>