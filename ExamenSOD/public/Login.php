<?php
require_once '../classes/User.php';
session_start();

$foutmelding = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    if ($user->login($_POST['email'], $_POST['wachtwoord'])) {
        header("Location: dashboard.php");
        exit;
    } else {
        $foutmelding = "Ongeldige inloggegevens.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<?php if ($foutmelding): ?>
    <p style="color:red;"><?php echo htmlspecialchars($foutmelding); ?></p>
<?php endif; ?>
<form method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Wachtwoord:</label><br>
    <input type="password" name="wachtwoord" required><br><br>
    <input type="submit" value="Inloggen">
</form>
<p>Geen account? <a href="register.php">Registreer hier</a></p>
</body>
</html>
