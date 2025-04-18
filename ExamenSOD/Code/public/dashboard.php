<?php
require_once '../classes/Auth.php';
require_once '../classes/Task.php';
require_once '../classes/User.php';

Auth::check();
$user = new User();
$task = new Task();

$gebruiker = $user->getUserById($_SESSION['user_id']);

$statusFilter = $_GET['status'] ?? null;
if ($statusFilter) {
    $taken = $task->getByStatus($_SESSION['user_id'], $statusFilter);
} else {
    $taken = $task->getAllByUser($_SESSION['user_id']);
}

?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<link rel="stylesheet" href="../css/style.css">
<body>
<div class="Loguit"><h2>Welkom, <?php echo htmlspecialchars($gebruiker['naam']); ?>!</h2> 
<a  href="login.php">Uitloggen</a></div>

<div class="Dashboard">

    <a href="add_task.php" class="Nieuwetaak">Nieuwe taak</a>

<h3>Jouw Taken</h3>  
<table border="1" cellpadding="5">
    <tr>
        <th>Titel</th>
        <th>Beschrijving</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Acties</th>
    </tr>

    <div class="status-filter">
    <a href="dashboard.php" class="<?php if (!isset($_GET['status'])) echo 'active'; ?>">Alle</a>
    <a href="dashboard.php?status=niet voltooid" class="<?php if ($_GET['status'] ?? '' === 'niet voltooid') echo 'active'; ?>">Niet voltooid</a>
    <a href="dashboard.php?status=in behandeling" class="<?php if ($_GET['status'] ?? '' === 'in behandeling') echo 'active'; ?>">In behandeling</a>
    <a href="dashboard.php?status=voltooid" class="<?php if ($_GET['status'] ?? '' === 'voltooid') echo 'active'; ?>">Voltooid</a>
</div>

   
    <?php foreach ($taken as $taak): ?>
        <tr>
            <td><?php echo htmlspecialchars($taak['titel']); ?></td>
            <td><?php echo htmlspecialchars($taak['beschrijving']); ?></td>
            <td><?php echo htmlspecialchars($taak['deadline']); ?></td>
            <td><?php echo htmlspecialchars($taak['status']); ?></td>
            <td class="Acties">

                <a href="edit_task.php?id=<?php echo $taak['id']; ?>">Bewerk</a> |
                <a href="delete_task.php?id=<?php echo $taak['id']; ?>" onclick="return confirm('Weet je het zeker dat je het wil verwijderen?')">Verwijder</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
</body>
</html>
