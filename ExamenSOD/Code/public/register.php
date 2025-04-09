<?php
require_once '../classes/User.php';
session_start();

$foutmelding = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $success = $user->register($_POST['naam'], $_POST['email'], $_POST['wachtwoord']);

    if ($success) {
        header("Location: login.php");
        exit;
    } else {
        $foutmelding = "Registratie mislukt. Probeer een ander e-mailadres.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Registreren</title></head>
<link rel="stylesheet" href="../css/style.css">
<body>
    <div class="containerLogin">
<h2>Registreren</h2>
<?php if ($foutmelding): ?>
    <p style="color:red;"><?php echo htmlspecialchars($foutmelding); ?></p>
<?php endif; ?>
<form class="LoginForm" method="POST">
    <label>Naam:</label><br>
    <input type="text" name="naam" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Wachtwoord:</label><br>
    <input type="password" name="wachtwoord" required><br><br>
    <input type="submit" value="Registreren">
</form>
</div>
</body>
</html>
