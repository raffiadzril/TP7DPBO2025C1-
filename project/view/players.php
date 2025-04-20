<?php
require_once 'class/Player.php';
require_once 'class/Team.php';
require_once 'class/Role.php';

$player = new Player();

if (isset($_GET['delete'])) {
    $player->deletePlayer($_GET['delete']);
    header("Location: index.php?page=players");
    exit;
}

if (isset($_POST['add_player'])) {
    $name = $_POST['name'];
    $team_id = $_POST['team_id'];
    $role_id = $_POST['role_id'];
    $team_id = $_POST['team_id'];
    $player->insertPlayer($name, $team_id, $role_id, $team_id);
    header("Location: index.php?page=players");
    exit;
}

$players = $player->getAllPlayers();

$searchName = isset($_GET['search']) ? $_GET['search'] : '';
$players = $searchName != '' ? $player->searchPlayer($searchName) : $player->getAllPlayers();

?>

<form method="GET" action="">
    <input type="hidden" name="page" value="players">
    <input type="text" name="search" placeholder="Cari nama player..." value="<?= htmlspecialchars($searchName) ?>">
    <button type="submit">Cari</button>
    <a href="index.php?page=players">Reset</a>
</form>


<h3>Daftar Pemain</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tim</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($players as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['name'] ?></td>
            <td><?= $p['team_name'] ?></td>
            <td><?= $p['role_name'] ?></td>
            <td>
                <a href="view/update/edit_player.php?id=<?= $p['id'] ?>">Edit</a> |
                <a href="index.php?page=players&delete=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Tambah Pemain</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Nama Pemain" required><br><br>
    <select name="team_id" required>
        <option value="">--Pilih Tim--</option>
        <?php foreach ((new Team())->getAllTeams() as $t): ?>
            <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <select name="role_id" required>
        <option value="">--Pilih Role--</option>
        <?php foreach ((new Role())->getAllRoles() as $r): ?>
            <option value="<?= $r['id'] ?>"><?= $r['role_name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit" name="add_player">Tambah</button>
</form>
