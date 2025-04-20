<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/config/db.php';

class Analyst {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllAnalysts() {
        $stmt = $this->db->query("SELECT Analysts.*, teams.name AS team_name FROM analysts JOIN teams ON analysts.team_id = teams.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertAnalyst($name, $specialty, $team_id) {
        $stmt = $this->db->prepare("INSERT INTO analysts (name, specialty, team_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $specialty, $team_id]);
    }

    public function updateAnalyst($id, $name, $specialty, $team_id) {
        $stmt = $this->db->prepare("UPDATE analysts SET name = ?, specialty = ?, team_id = ? WHERE id = ?");
        return $stmt->execute([$name, $specialty, $team_id, $id]);
    }

    public function deleteAnalyst($id) {
        $stmt = $this->db->prepare("DELETE FROM analysts WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function searchAanalyst($name) {
        $stmt = $this->db->prepare("SELECT analysts.*, teams.name AS team_name FROM analysts JOIN teams ON analysts.team_id = teams.id WHERE analysts.name LIKE ?");
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
