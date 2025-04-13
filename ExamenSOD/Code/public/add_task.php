<?php
require_once '../classes/Auth.php';
require_once '../classes/Task.php';

Auth::check();
$task = new Task();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task->create($_POST['titel'], $_POST['beschrijving'], $_POST['deadline'], $_SESSION['user_id']);
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Taak toevoegen</title></head>
<link rel="stylesheet" href="../css/style.css">
<body>
    <div class="containerTaak">
<h2>Nieuwe Taak Toevoegen</h2>
<form method="POST">
    <label>Titel*:</label><br>
    <input type="text" name="titel" required><br>
    <label>Beschrijving*:</label><br>
    <textarea   name="beschrijving" required ></textarea><br>
    <label>Deadline*:</label><br>
    <input type="date" name="deadline" required><br><br>
    <input type="submit" value="Opslaan">
</form>
<a href="dashboard.php">← Terug naar dashboard</a>
</div>

</body>
</html>
