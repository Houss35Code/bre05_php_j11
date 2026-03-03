<?php
require_once 'AbstractManager.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryManager extends AbstractManager {
    public function __construct() {
        parent::__construct();
    }

    public function findAll(): array {
        $query = $this->db->query("SELECT * FROM categories");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];

        foreach ($results as $data) {
            $category = new Category($data['title'], $data['description']);
            $category->id = $data['id'];
            $categories[] = $category;
        }
        return $categories;
    }

    public function findOne(int $id): ?Category {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $category = new Category($data['title'], $data['description']);
        $category->id = $data['id'];
        return $category;
    }

    public function create(Category $category): void {
        $stmt = $this->db->prepare("INSERT INTO categories (title, description) VALUES (?, ?)");
        $stmt->execute([$category->title, $category->description]);
        $category->id = (int)$this->db->lastInsertId();
    }

    public function update(Category $category): void {
        $stmt = $this->db->prepare("UPDATE categories SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$category->title, $category->description, $category->id]);
    }

    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }
}