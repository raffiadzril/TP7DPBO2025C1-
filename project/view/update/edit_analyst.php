<?php
require_once '../../class/Analyst.php';  // Path relatif dari folder 'view/update' ke 'class/Analyst.php'
require_once '../../class/Team.php';     // Path relatif dari folder 'view/update' ke 'class/Team.php'

$analyst = new Analyst();
$team = new Team();

if (!isset($_GET['id'])) {
    header("Location: ../../index.php/?page=analysts");
    exit;
}

$id = $_GET['id'];
$data = null;

foreach ($analyst->getAllAnalysts() as $a) {
    if ($a['id'] == $id) {
        $data = $a;
        break;
    }
}

if (!$data) {
    echo "Data analis tidak ditemukan.";
    exit;
}

$teams = $team->getAllTeams();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $updatedData = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'specialty' => $_POST['specialty'],
        'team_id' => $_POST['team_id']
    ];

    $analyst->updateAnalyst($updatedData['id'], $updatedData['name'], $updatedData['specialty'], $updatedData['team_id']); // Pastikan Anda memiliki metode updateAnalyst di kelas Analyst
    header("Location: ../../index.php");
    exit;
}
?>

<h3>Edit Data Analis</h3>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <label>Nama:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>

    <label>Spesialisasi:</label><br>
    <input type="text" name="specialty" value="<?= htmlspecialchars($data['specialty']) ?>" required><br><br>

    <label>Tim:</label><br>
    <select name="team_id" required>
        <?php foreach ($teams as $t): ?>
            <option value="<?= $t['id'] ?>" <?= $t['id'] == $data['team_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($t['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit" name="update">Update</button>
    <a href="../../index.php">Batal</a>
</form>
