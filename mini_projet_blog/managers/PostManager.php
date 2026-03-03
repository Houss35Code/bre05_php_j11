<?php
require_once 'AbstractManager.php';
require_once 'UserManager.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Category.php';

class PostManager extends AbstractManager {
    
    // Récupère un post par son ID avec son auteur
    public function findOne(int $id): ?Post {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        // Récupération de l'objet User via le UserManager
        $userManager = new UserManager();
        $author = $userManager->findOne($data['author']); // 'author' est l'ID dans posts.sql

        $post = new Post(
            $data['title'], 
            $data['excerpt'], 
            $data['content'], 
            $author, 
            new DateTime($data['created_at'])
        );
        $post->id = $data['id'];
        
        return $post;
    }

    // Récupère tous les posts
    public function findAll(): array {
        $query = $this->db->query("SELECT id FROM posts");
        $ids = $query->fetchAll(PDO::FETCH_COLUMN);
        
        $posts = [];
        foreach ($ids as $id) {
            $posts[] = $this->findOne($id);
        }
        return $posts;
    }

    // ÉTAPE 2 : Charge les catégories associées à un post spécifique
    public function loadCategories(Post $post): void {
        $stmt = $this->db->prepare("
            SELECT c.* FROM categories c
            JOIN posts_categories pc ON pc.category_id = c.id
            WHERE pc.post_id = :post_id
        ");
        $stmt->execute(['post_id' => $post->id]);
        $categoriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categoriesData as $data) {
            $category = new Category($data['title'], $data['description']);
            $category->id = $data['id'];
            $post->addCategory($category); // Ajoute la catégorie au tableau du Post
        }
    }
}