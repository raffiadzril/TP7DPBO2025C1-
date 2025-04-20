<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/config/db.php';


class MPLId {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllMplIds() {
        $stmt = $this->db->query("SELECT mpl_ids.*, teams.name AS team_name FROM mpl_ids JOIN teams ON mpl_ids.team_id = teams.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertMplId($peringkat, $team_id) {
        $stmt = $this->db->prepare("INSERT INTO mpl_ids (peringkat, team_id) VALUES (?, ?)");
        return $stmt->execute([$peringkat, $team_id]);
    }

    public function updateMplId($id, $mpl_code, $team_id) {
        $stmt = $this->db->prepare("UPDATE mpl_ids SET peringkat = ?, team_id = ? WHERE id = ?");
        return $stmt->execute([$mpl_code, $team_id, $id]);
    }

    public function deleteMplId($id) {
        $stmt = $this->db->prepare("DELETE FROM mpl_ids WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function searchMplId($mpl_code) {
        $stmt = $this->db->prepare("SELECT mpl_ids.*, teams.name AS team_name FROM mpl_ids JOIN teams ON mpl_ids.team_id = teams.id WHERE mpl_ids.peringkat LIKE ?");
        $stmt->execute(['%' . $mpl_code . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
