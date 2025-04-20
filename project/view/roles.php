<?php
require_once 'class/Role.php';
$role = new Role();

if (isset($_GET['delete'])) {
    $role->deleteRole($_GET['delete']);
    header("Location: index.php?page=roles");
    exit;
}

if (isset($_POST['add_role'])) {
    $role->insertRole($_POST['name']);
    header("Location: index.php?page=roles");
    exit;
}

$roles = $role->getAllRoles();
?>

<h3>Daftar Role</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama Role</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($roles as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['role_name'] ?></td>
            <td>
                <a href="view/update/edit_role.php?id=<?= $r['id'] ?>">Edit</a> |
                <a href="index.php?page=roles&delete=<?= $r['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Tambah Role</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Nama Role" required>
    <button type="submit" name="add_role">Tambah</button>
</form>
