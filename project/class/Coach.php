<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/config/db.php';


class Coach {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllCoaches() {
        $stmt = $this->db->query("SELECT coaches.*, teams.name AS team_name FROM coaches JOIN teams ON coaches.team_id = teams.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertCoach($name, $experience_year, $team_id) {
        $stmt = $this->db->prepare("INSERT INTO coaches (name, experience_year, team_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $experience_year, $team_id]);
    }

    public function updateCoach($id, $name, $experience_year, $team_id) {
        $stmt = $this->db->prepare("UPDATE coaches SET name = ?, experience_year = ?, team_id = ? WHERE id = ?");
        return $stmt->execute([$name, $experience_year, $team_id, $id]);
    }

    public function deleteCoach($id) {
        $stmt = $this->db->prepare("DELETE FROM coaches WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function searchCoach($name) {
        $stmt = $this->db->prepare("SELECT coaches.*, teams.name AS team_name FROM coaches JOIN teams ON coaches.team_id = teams.id WHERE coaches.name LIKE ?");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
