<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/class/Team.php';

$team = new Team();

if (!isset($_GET['id'])) {
    header("Location: ../../index.php?page=teams");
    exit;
}

$id = $_GET['id'];
$teams = $team->getAllTeams();
$data = null;

foreach ($teams as $t) {
    if ($t['id'] == $id) {
        $data = $t;
        break;
    }
}

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $region = $_POST['region'];
    $founded_year = $_POST['founded_year'];
    $team->updateTeam($id, $name, $region, $founded_year);
    header("Location: ../../index.php?page=teams");
    exit;
}
?>

<h3>Edit Tim</h3>
<form method="POST">
    <label>Nama Tim:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>

    <label>Region:</label><br>
    <input type="text" name="region" value="<?= htmlspecialchars($data['region']) ?>" required><br><br>

    <label>Tahun Berdiri:</label><br>
    <input type="number" name="founded_year" value="<?= htmlspecialchars($data['founded_year']) ?>" required><br><br>

    <button type="submit" name="update">Update</button>
    <a href="../../index.php?page=teams">Batal</a>
</form>
