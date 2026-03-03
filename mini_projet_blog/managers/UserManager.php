<?php
require_once 'AbstractManager.php';
require_once __DIR__ . '/../models/User.php';

class UserManager extends AbstractManager {
    public function findOne(int $id): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;

        $user = new User($data['username'], $data['email'], $data['password'], $data['role'], new DateTime($data['created_at']));
        $user->id = $data['id'];
        return $user;
    }
}