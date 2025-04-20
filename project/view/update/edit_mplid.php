<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/class/MPLId.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/class/Team.php';

$mplid = new MPLId();
$team = new Team();

if (!isset($_GET['id'])) {
    header("Location: ../../index.php?page=mplid");
    exit;
}

$id = $_GET['id'];
$mplids = $mplid->getAllMplIds();
$data = null;

foreach ($mplids as $m) {
    if ($m['id'] == $id) {
        $data = $m;
        break;
    }
}

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

$teams = $team->getAllTeams();

if (isset($_POST['update'])) {
    $peringkat = $_POST['peringkat'];
    $team_id = $_POST['team_id'];
    $mplid->updateMplId($id, $peringkat, $team_id);
    header("Location: ../../index.php?page=mplid");
    exit;
}
?>

<h3>Edit MPL ID</h3>
<form method="POST">
    <label>Peringkat:</label><br>
    <input type="number" name="peringkat" value="<?= htmlspecialchars($data['peringkat']) ?>" required><br><br>

    <label>Nama Tim:</label><br>
    <select name="team_id" required>
        <?php foreach ($teams as $t): ?>
            <option value="<?= $t['id'] ?>" <?= $t['id'] == $data['team_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($t['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit" name="update">Update</button>
    <a href="../../index.php?page=mplid">Batal</a>
</form>
