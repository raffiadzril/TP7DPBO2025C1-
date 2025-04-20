<?php
require_once '../../class/Player.php';
require_once '../../class/Team.php';
require_once '../../class/Role.php';

$player = new Player();
$id = $_GET['id'] ?? null;
$data = null;

foreach ($player->getAllPlayers() as $p) {
    if ($p['id'] == $id) {
        $data = $p;
        break;
    }
}

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    $player->updatePlayer($_POST['id'], $_POST['name'], $_POST['team_id'], $_POST['role_id'], $_POST['team_id']);
    header("Location: ../../index.php?page=players");
    exit;
}

$teams = (new Team())->getAllTeams();
$roles = (new Role())->getAllRoles();
?>

<h3>Edit Pemain</h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required><br><br>
    <select name="team_id" required>
        <?php foreach ($teams as $t): ?>
            <option value="<?= $t['id'] ?>" <?= $t['id'] == $data['team_id'] ? 'selected' : '' ?>>
                <?= $t['name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    <select name="role_id" required>
        <?php foreach ($roles as $r): ?>
            <option value="<?= $r['id'] ?>" <?= $r['id'] == $data['role_id'] ? 'selected' : '' ?>>
                <?= $r['role_name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit" name="update">Update</button>
    <a href="../../index.php?page=players">Batal</a>
</form>
