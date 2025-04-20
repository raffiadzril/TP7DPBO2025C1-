<?php
require_once 'class/Coach.php';
require_once 'class/Team.php';

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $coach = new Coach();
    $result = $coach->deleteCoach($id);

    if ($result) {
        echo "<script>alert('Pelatih berhasil dihapus!'); window.location.href='index.php?page=coaches';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pelatih.');</script>";
    }
}

// Handle insert request
if (isset($_POST['add_coach'])) {
    $name = $_POST['name'];
    $experience_year = $_POST['experience_year'];
    $team_id = $_POST['team_id'];

    $coachNew = new Coach();
    $result = $coachNew->insertCoach($name, $experience_year, $team_id);

    if ($result) {
        echo "<script>alert('Pelatih berhasil ditambahkan!'); window.location.href='index.php?page=coaches';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pelatih.');</script>";
    }
}

$coach = new Coach();
$coaches = $coach->getAllCoaches();

$searchName = isset($_GET['search']) ? $_GET['search'] : '';
$coaches = $searchName != '' ? $coach->searchCoach($searchName) : $coach->getAllCoaches();

?>

<form method="GET" action="">
    <input type="hidden" name="page" value="coaches">
    <input type="text" name="search" placeholder="Cari nama coach..." value="<?= htmlspecialchars($searchName) ?>">
    <button type="submit">Cari</button>
    <a href="index.php?page=coaches">Reset</a>
</form>


<h3>Daftar Pelatih</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Pengalaman (Tahun)</th>
        <th>Tim</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($coaches as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['id']) ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['experience_year']) ?></td>
            <td><?= htmlspecialchars($c['team_name']) ?></td>
            <td>
                <a href="view/update/edit_coach.php?id=<?= $c['id'] ?>">Edit</a> |
                <a href="index.php?page=coaches&delete=<?= $c['id'] ?>" onclick="return confirm('Yakin hapus pelatih ini?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Tambah Pelatih</h3>
<form method="POST" action="index.php?page=coaches">
    <label>Nama:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Pengalaman (Tahun):</label><br>
    <input type="number" name="experience_year" required><br><br>

    <label>Tim:</label><br>
    <select name="team_id" required>
        <?php
        $team = new Team();
        foreach ($team->getAllTeams() as $t) {
            echo "<option value=\"{$t['id']}\">{$t['name']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit" name="add_coach">Tambah Pelatih</button>
</form>