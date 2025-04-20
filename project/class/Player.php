<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/config/db.php';


class Player {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllPlayers() {
        $stmt = $this->db->query("
            SELECT players.*, teams.name AS team_name, roles.role_name AS role_name 
            FROM players 
            JOIN teams ON players.team_id = teams.id 
            JOIN roles ON players.role_id = roles.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertPlayer($name, $age, $role_id, $team_id) {
        $stmt = $this->db->prepare("INSERT INTO players (name, age, role_id, team_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $age, $role_id, $team_id]);
    }

    public function updatePlayer($id, $name, $age, $role_id, $team_id) {
        $stmt = $this->db->prepare("UPDATE players SET name = ?, age = ?, role_id = ?, team_id = ? WHERE id = ?");
        return $stmt->execute([$name, $age, $role_id, $team_id, $id]);
    }

    public function deletePlayer($id) {
        $stmt = $this->db->prepare("DELETE FROM players WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function searchPlayer($name) {
        $stmt = $this->db->prepare("SELECT players.*, teams.name AS team_name, roles.role_name AS role_name 
            FROM players 
            JOIN teams ON players.team_id = teams.id 
            JOIN roles ON players.role_id = roles.id 
            WHERE players.name LIKE ?
        ");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
