<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/class/MPLId.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/class/Team.php';

$mplid = new MPLId();
$team = new Team();

if (isset($_GET['delete'])) {
    $mplid->deleteMplId($_GET['delete']);
    header("Location: index.php?page=mplid");
    exit;
}

if (isset($_POST['add_mplid'])) {
    $peringkat = $_POST['peringkat'];
    $team_id = $_POST['team_id'];
    $mplid->insertMplId($peringkat, $team_id);
    header("Location: index.php?page=mplid");
    exit;
}

$mplids = $mplid->getAllMplIds();
$teams = $team->getAllTeams();



?>



<br
<h3>Daftar MPL ID</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Peringkat</th>
        <th>Nama Tim</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($mplids as $m): ?>
        <tr>
            <td><?= $m['id'] ?></td>
            <td><?= htmlspecialchars($m['peringkat']) ?></td>
            <td><?= htmlspecialchars($m['team_name']) ?></td>
            <td>
                <a href="view/update/edit_mplid.php?id=<?= $m['id'] ?>">Edit</a> |
                <a href="index.php?page=mplid&delete=<?= $m['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Tambah MPL ID</h3>
<form method="POST">
    <input type="number" name="peringkat" placeholder="Peringkat" required><br><br>

    <select name="team_id" required>
        <option value="">-- Pilih Tim --</option>
        <?php foreach ($teams as $t): ?>
            <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit" name="add_mplid">Tambah</button>
</form>
