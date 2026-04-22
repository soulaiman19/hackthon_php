<?php
require 'auth.php';
requireLogin();
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Tableau de bord</title>

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
    content: "👤";
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

/* TEXT */
p {
    color: #ddd;
    margin-bottom: 10px;
}

/* ACTIONS */
.actions {
    margin-top: 20px;
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

/* LOGOUT BUTTON (primary) */
a[href="logout.php"] {
    background: linear-gradient(135deg, #4f6df5, #6a5af9);
    color: white;
    box-shadow: 0 5px 20px rgba(79,109,245,0.5);
}

/* RETURN BUTTON (transparent) */
a[href="index.php"] {
    background: transparent;
    border: 2px solid rgba(255,255,255,0.6);
    color: white;
}

/* HOVER */
a:hover {
    transform: scale(1.05);
}
</style>

</head>
<body>

<div class="container">
    <h1>Tableau de bord</h1>
    <p>Bienvenue <strong><?= htmlspecialchars($user['email']) ?></strong> !</p>

    <div class="actions">
        <h3>Actions</h3>
        <a href="logout.php">→ Se déconnecter</a>
        <a href="index.php">→ Retour à l'accueil</a>
    </div>
</div>

</body>
</html>