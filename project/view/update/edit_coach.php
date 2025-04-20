<?php
require_once '../../class/Coach.php';
require_once '../../class/Team.php';

$coach = new Coach();
$team = new Team();

if (!isset($_GET['id'])) {
    header("Location: ../../index.php?page=coaches");
    exit;
}

$id = $_GET['id'];
$data = null;

foreach ($coach->getAllCoaches() as $c) {
    if ($c['id'] == $id) {
        $data = $c;
        break;
    }
}

if (!$data) {
    echo "Data pelatih tidak ditemukan.";
    exit;
}

$teams = $team->getAllTeams();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $coach->updateCoach($_POST['id'], $_POST['name'], $_POST['experience_year'], $_POST['team_id']);
    header("Location: ../../index.php?page=coaches");
    exit;
}
?>

<h3>Edit Data Pelatih</h3>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <label>Nama:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>

    <label>Pengalaman (Tahun):</label><br>
    <input type="number" name="experience_year" value="<?= htmlspecialchars($data['experience_year']) ?>" required><br><br>

    <label>Tim:</label><br>
    <select name="team_id" required>
        <?php foreach ($teams as $t): ?>
            <option value="<?= $t['id'] ?>" <?= $t['id'] == $data['team_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($t['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit" name="update">Update</button>
    <a href="../../index.php?page=coaches">Batal</a>
</form>
