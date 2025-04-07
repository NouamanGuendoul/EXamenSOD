<?php
require_once '../classes/Auth.php';
require_once '../classes/Task.php';

Auth::check();
$task = new Task();

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$taak = $task->getById($_GET['id']);

if (!$taak || $taak['gebruiker_id'] != $_SESSION['user_id']) {
    die("Toegang geweigerd.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task->update($_GET['id'], $_POST['titel'], $_POST['beschrijving'], $_POST['deadline'], $_POST['status']);
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Bewerk Taak</title></head>
<body>
<h2>Taak bewerken</h2>
<form method="POST">
    <label>Titel:</label><br>
    <input type="text" name="titel" value="<?php echo htmlspecialchars($taak['titel']); ?>" required><br>
    <label>Beschrijving:</label><br>
    <textarea name="beschrijving"><?php echo htmlspecialchars($taak['beschrijving']); ?></textarea><br>
    <label>Deadline:</label><br>
    <input type="date" name="deadline" value="<?php echo htmlspecialchars($taak['deadline']); ?>"><br>
    <label>Status:</label><br>
    <select name="status">
        <option value="niet voltooid" <?php if ($taak['status'] === 'niet voltooid') echo 'selected'; ?>>Niet voltooid</option>
        <option value="voltooid" <?php if ($taak['status'] === 'voltooid') echo 'selected'; ?>>Voltooid</option>
    </select><br><br>
    <input type="submit" value="Opslaan">
</form>
<a href="dashboard.php">← Terug</a>
</body>
</html>
