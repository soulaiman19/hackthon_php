<?php
require 'auth.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$message = '';
$error = '';
$verificationLink = '';
$formData = [
    'name' => '',
    'family_name' => '',
    'date_of_birth' => '',
    'email' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['name'] = trim((string) ($_POST['name'] ?? ''));
    $formData['family_name'] = trim((string) ($_POST['family_name'] ?? ''));
    $formData['date_of_birth'] = trim((string) ($_POST['date_of_birth'] ?? ''));
    $formData['email'] = trim((string) ($_POST['email'] ?? ''));

    $result = createUser($_POST);

    if (!$result['success']) {
        $error = $result['message'];
    } else {
        $message = 'Inscription reussie ! Verifiez votre email avant de vous connecter.';
        $verificationLink = 'verify_email.php?email=' . urlencode($result['email']) . '&code=' . urlencode($result['code']);
        $formData = [
            'name' => '',
            'family_name' => '',
            'date_of_birth' => '',
            'email' => '',
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Register</title>

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
min-height:100%;
margin:0;
padding:0;
overflow:auto;
}

body{
min-height:100vh;
display:flex;
justify-content:space-between;
align-items:center;
padding:30px 0;
}

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

.left{
color:white;
margin-left:60px;
max-width:420px;
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

.login-box{
width:420px;
padding:30px;
border-radius:25px;
background: rgba(255,255,255,0.1);
backdrop-filter: blur(20px);
color:white;
box-shadow:0 10px 40px rgba(0,0,0,0.5);
margin-right:60px;
}

.input-row{
display:flex;
gap:12px;
}

.input-row .input-group{
flex:1;
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
margin-top:18px;
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

.message{
background:#4caf50;
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

.info{
font-size:13px;
margin-top:10px;
word-break:break-all;
}

@media (max-width: 920px) {
body {
flex-direction: column;
justify-content: center;
gap: 30px;
padding: 90px 20px 30px;
}

.left,
.login-box {
margin: 0;
width: min(100%, 420px);
}

.left h1 {
font-size: 52px;
}
}

@media (max-width: 560px) {
.input-row {
flex-direction: column;
gap: 0;
}

.login-box {
padding: 24px;
}
}
</style>

</head>

<body>

<video autoplay muted loop id="bgVideo">
<source src="video.mp4" type="video/mp4">
</video>

<div class="logo">
<img src="imag.jpeg" alt="SocialBook logo">
<span>SocialBook</span>
</div>

<div class="left">
<h1>SocialBook</h1>
<p>Create your account and join the community.</p>
</div>

<div class="login-box">

<h2>Inscription</h2>

<?php if ($error): ?>
<div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if ($message): ?>
<div class="message"><?= htmlspecialchars($message) ?></div>

<div class="info">
<p><strong>Lien de verification :</strong></p>
<p>
<a href="<?= htmlspecialchars($verificationLink) ?>" target="_blank" rel="noopener noreferrer">
<?= htmlspecialchars($verificationLink) ?>
</a>
</p>
</div>
<?php else: ?>
<form method="post" action="register.php" novalidate>
<div class="input-row">
<div class="input-group">
<label for="name">First Name</label>
<input type="text" id="name" name="name" maxlength="100" value="<?= htmlspecialchars($formData['name']) ?>" required>
</div>

<div class="input-group">
<label for="family_name">Last Name</label>
<input type="text" id="family_name" name="family_name" maxlength="100" value="<?= htmlspecialchars($formData['family_name']) ?>" required>
</div>
</div>

<div class="input-group">
<label for="date_of_birth">Date of Birth</label>
<input type="date" id="date_of_birth" name="date_of_birth" max="<?= date('Y-m-d') ?>" value="<?= htmlspecialchars($formData['date_of_birth']) ?>" required>
</div>

<div class="input-group">
<label for="email">Email</label>
<input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email']) ?>" required>
</div>

<div class="input-group">
<label for="password">Password</label>
<input type="password" id="password" name="password" minlength="8" required>
</div>

<button type="submit">Creer un compte</button>
</form>
<?php endif; ?>

<div class="bottom">
<a href="login.php">Vous avez un compte ? Connectez-vous</a>
</div>

</div>

</body>
</html>
