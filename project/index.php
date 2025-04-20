<?php
require_once 'config/db.php';
require_once 'class/Team.php';
require_once 'class/Role.php';
require_once 'class/Player.php';
require_once 'class/Coach.php';
require_once 'class/Analyst.php';
require_once 'class/MPLID.php';

$team = new Team();
$role = new Role();
$player = new Player();
$coach = new Coach();
$analyst = new Analyst();
$mplid = new MPLID();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MLBB Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h2>Mobile Legends Management System</h2>
        <h3>Selamat datang di sistem manajemen Mobile Legends!</h3>
        <p>Silakan pilih menu di bawah ini untuk mengelola data tim, pemain, pelatih, analis, dan MPL ID.</p>
        <nav>
            <a href="?page=teams">Teams</a> |
            <a href="?page=players">Players</a> |
            <a href="?page=roles">Roles</a> |
            <a href="?page=coaches">Coaches</a> |
            <a href="?page=analysts">Analysts</a> |
            <a href="?page=mplids">MPL ID</a>
        </nav>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $valid_pages = ['teams', 'players', 'roles', 'coaches', 'analysts', 'mplids'];
            if (in_array($page, $valid_pages)) {
                include "view/{$page}.php";
            } else {
                echo "<p>Halaman tidak ditemukan.</p>";
            }
        }
        ?>
    </main>
</body>
</html>
