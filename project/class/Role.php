<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/TP7DPBO2025C1/config/db.php';


class Role {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllRoles() {
        $stmt = $this->db->query("SELECT * FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertRole($role_name) {
        $stmt = $this->db->prepare("INSERT INTO roles (role_name) VALUES (?)");
        return $stmt->execute([$role_name]);
    }

    public function updateRole($id, $role_name) {
        $stmt = $this->db->prepare("UPDATE roles SET role_name = ? WHERE id = ?");
        return $stmt->execute([$role_name, $id]);
    }

    public function deleteRole($id) {
        $stmt = $this->db->prepare("DELETE FROM roles WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function searchRole($role_name) {
        $stmt = $this->db->prepare("SELECT * FROM roles WHERE role_name LIKE ?");
        $stmt->execute(['%' . $role_name . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
