<?php
require_once '../classes/Auth.php';
require_once '../classes/Task.php';
require_once '../classes/User.php';

Auth::check();
$user = new User();
$task = new Task();

$gebruiker = $user->getUserById($_SESSION['user_id']);
$taken = $task->getAllByUser($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h2>Welkom, <?php echo htmlspecialchars($gebruiker['naam']); ?>!</h2>
<a href="logout.php">Uitloggen</a> | <a href="add_task.php">+ Nieuwe taak</a>

<h3>Jouw Taken</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>Titel</th>
        <th>Beschrijving</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Acties</th>
    </tr>
    <?php foreach ($taken as $taak): ?>
        <tr>
            <td><?php echo htmlspecialchars($taak['titel']); ?></td>
            <td><?php echo htmlspecialchars($taak['beschrijving']); ?></td>
            <td><?php echo htmlspecialchars($taak['deadline']); ?></td>
            <td><?php echo htmlspecialchars($taak['status']); ?></td>
            <td>
                <a href="edit_task.php?id=<?php echo $taak['id']; ?>">Bewerk</a> |
                <a href="delete_task.php?id=<?php echo $taak['id']; ?>" onclick="return confirm('Weet je het zeker?')">Verwijder</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
