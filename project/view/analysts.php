<?php
require_once 'class/Analyst.php';
require_once 'class/Team.php';

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $analyst = new Analyst();
    $result = $analyst->deleteAnalyst($id);

    if ($result) {
        echo "<script>alert('Analis berhasil dihapus!'); window.location.href='index.php?page=analysts';</script>";
    } else {
        echo "<script>alert('Gagal menghapus analis.');</script>";
    }
}

// Handle insert request
if (isset($_POST['add_analyst'])) {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $team_id = $_POST['team_id'];

    $analystNew = new Analyst();

    $result = $analystNew->insertAnalyst($name, $specialty, $team_id);

    if ($result) {
        echo "<script>alert('Analis berhasil ditambahkan!'); window.location.href='index.php?page=analysts';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan analis.');</script>";
    }
}

// Fetch all analysts
$analyst = new Analyst();
$analysts = $analyst->getAllAnalysts();

$searchName = isset($_GET['search']) ? $_GET['search'] : '';
if ($searchName != '') {
    $analysts = $analyst->searchAanalyst($searchName);
} else {
    $analysts = $analyst->getAllAnalysts();
}


?>


<form method="GET" action="">
    <input type="hidden" name="page" value="analysts">
    <input type="text" name="search" placeholder="Cari nama analyst..." value="<?= htmlspecialchars($searchName) ?>">
    <button type="submit">Cari</button>
    <a href="index.php?page=analysts">Reset</a>
</form>
<br>

<br>

<h3>Daftar Analis</h3>


<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Spesialisasi</th>
            <th>Tim</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($analysts as $a): ?>
            <tr>
                <td><?= htmlspecialchars($a['id']) ?></td>
                <td><?= htmlspecialchars($a['name']) ?></td>
                <td><?= htmlspecialchars($a['specialty']) ?></td>
                <td><?= htmlspecialchars($a['team_name']) ?></td>
                <td>
                    <a href="view/update/edit_analyst.php?id=<?= $a['id'] ?>">Edit</a> |
                    <a href="index.php?page=analysts&delete=<?= $a['id'] ?>" onclick="return confirm('Are you sure you want to delete this analyst?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Tambah Analis</h3>
<form method="POST" action="index.php?page=analysts">
    <label>Nama:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Spesialisasi:</label><br>
    <input type="text" name="specialty" required><br><br>

    <label>Tim:</label><br>
    <select name="team_id" required>
        <?php
        require_once 'class/Team.php';
        $team= new Team();
        $teams = $team->getAllTeams();
        foreach ($teams as $t) {
            echo "<option value=\"{$t['id']}\">{$t['name']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit" name="add_analyst">Tambah Analis</button>
</form>
