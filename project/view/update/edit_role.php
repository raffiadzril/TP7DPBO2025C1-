<?php
require_once '../../class/Role.php';
$role = new Role();

if (!isset($_GET['id'])) {
    header("Location: ../../index.php?page=roles");
    exit;
}

$id = $_GET['id'];
$data = null;

foreach ($role->getAllRoles() as $r) {
    if ($r['id'] == $id) {
        $data = $r;
        break;
    }
}

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if (isset($_POST['update'])) {
    $role->updateRole($_POST['id'], $_POST['name']);
    header("Location: ../../index.php?page=roles");
    exit;
}
?>

<h3>Edit Role</h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>
    <button type="submit" name="update">Update</button>
    <a href="../../index.php?page=roles">Batal</a>
</form>
