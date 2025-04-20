<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/class/Team.php';

$team = new Team();

if (isset($_GET['delete'])) {
    $team->deleteTeam($_GET['delete']);
    header("Location: index.php?page=teams");
    exit;
}

if (isset($_POST['add_team'])) {
    $name = $_POST['name'];
    $region = $_POST['region'];
    $founded_year = $_POST['founded_year'];
    $team->insertTeam($name, $region, $founded_year);
    header("Location: index.php?page=teams");
    exit;
}

$teams = $team->getAllTeams();

$searchName = isset($_GET['search']) ? $_GET['search'] : '';
$teams = $searchName != '' ? $team->searchTeam($searchName) : $team->getAllTeams();

?>

<form method="GET" action="">
    <input type="hidden" name="page" value="teams">
    <input type="text" name="search" placeholder="Cari nama tim..." value="<?= htmlspecialchars($searchName) ?>">
    <button type="submit">Cari</button>
    <a href="index.php?page=teams">Reset</a>
</form>


<h3>Daftar Tim</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama Tim</th>
        <th>Region</th>
        <th>Tahun Berdiri</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($teams as $t): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= htmlspecialchars($t['name']) ?></td>
            <td><?= htmlspecialchars($t['region']) ?></td>
            <td><?= htmlspecialchars($t['founded_year']) ?></td>
            <td>
                <a href="view/update/edit_team.php?id=<?= $t['id'] ?>">Edit</a> |
                <a href="index.php?page=teams&delete=<?= $t['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Tambah Tim</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Nama Tim" required><br><br>
    <input type="text" name="region" placeholder="Region" required><br><br>
    <input type="number" name="founded_year" placeholder="Tahun Berdiri" required><br><br>
    <button type="submit" name="add_team">Tambah</button>
</form>
