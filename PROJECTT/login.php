<?php
require 'auth.php';

if (isLoggedIn()) {
    header('Location: home.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password'] ?? '');

    if (!$email || $password === '') {
        $error = 'Veuillez saisir un email et un mot de passe.';
    } else {
        $result = authenticate($email, $password);
        if ($result === null) {
            $error = 'Email ou mot de passe incorrect.';
        } elseif ($result === 'not_verified') {
            $error = 'Votre adresse email n\'a pas encore été vérifiée.';
        } else {
            loginUser($result);
            header('Location: home.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family: Arial;
}

html,body{
width:100%;
height:100%;
margin:0;
padding:0;
overflow:hidden;
}

body{
height:100vh;
display:flex;
justify-content:space-between;
align-items:center;
}

/* VIDEO */
#bgVideo{
position: fixed;
top:0;
left:0;
width:100%;
height:100%;
object-fit: cover;
z-index:-2;
}

body::before{
content:"";
position:fixed;
width:100%;
height:100%;
background: rgba(0,0,0,0.6);
z-index:-1;
}

/* logo */

.logo{
position: fixed;
top: 20px;
left: 30px;
display: flex;
align-items: center;
color: white;
z-index:10;
}

.logo img{
width:40px;
margin-right:10px;
}

/* left */

.left{
color:white;
margin-left:60px;
}

.left h1{
font-size:70px;
font-family: 'Playfair Display', serif;
font-style:italic;
}

.left p{
font-size:20px;
margin-top:15px;
opacity:0.8;
font-family: 'Poppins', sans-serif;
}

/* login box */

.login-box{
width:380px;
padding:30px;
border-radius:25px;
background: rgba(255,255,255,0.1);
backdrop-filter: blur(20px);
color:white;
box-shadow:0 10px 40px rgba(0,0,0,0.5);
margin-right:60px;
}

.input-group{
margin-top:15px;
}

.input-group input{
width:100%;
padding:12px;
border-radius:10px;
border:none;
margin-top:5px;
}

button{
width:100%;
padding:12px;
border:none;
border-radius:20px;
background:#6a5af9;
color:white;
cursor:pointer;
margin-top:15px;
}

button:hover{
background:#5848e5;
}

.error{
background:#ff4d4d;
padding:10px;
border-radius:8px;
margin-bottom:10px;
}

.bottom{
text-align:center;
margin-top:15px;
}

.bottom a{
color:#8c7bff;
text-decoration:none;
}

.bottom a:hover{
text-decoration:underline;
}

</style>

</head>

<body>

<video autoplay muted loop id="bgVideo">
<source src="video.mp4" type="video/mp4">
</video>

<div class="logo">
<img src="imag.jpeg">
<span>SocialBook</span>
</div>

<div class="left">
<h1>SocialBook</h1>
<p>Connect with friends and the world around you.</p>
</div>

<div class="login-box">

<h2>Connexion</h2>

<?php if ($error): ?>
<div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" action="login.php">

<div class="input-group">
<label>Email</label>
<input type="email" name="email" required>
</div>

<div class="input-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<button type="submit">Se connecter</button>

</form>

<div class="bottom">
<a href="register.php">Créer un compte</a>
</div>

</div>

</body>
</html>