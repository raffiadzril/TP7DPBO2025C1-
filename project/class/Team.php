<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/config/db.php';



class Team {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllTeams() {
        $stmt = $this->db->query("SELECT * FROM teams");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertTeam($name, $region, $founded_year) {
        $stmt = $this->db->prepare("INSERT INTO teams (name, region, founded_year) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $region, $founded_year]);
    }

    public function updateTeam($id, $name, $region, $founded_year) {
        $stmt = $this->db->prepare("UPDATE teams SET name = ?, region = ?, founded_year = ? WHERE id = ?");
        return $stmt->execute([$name, $region, $founded_year, $id]);
    }

    public function deleteTeam($id) {
        $stmt = $this->db->prepare("DELETE FROM teams WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function searchTeam($name) {
        $stmt = $this->db->prepare("SELECT * FROM teams WHERE name LIKE ?");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
