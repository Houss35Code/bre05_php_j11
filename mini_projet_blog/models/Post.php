<?php
class Post {
    public ?int $id = null;
    public array $categories = [];

    public function __construct(
        public string $title,
        public string $excerpt,
        public string $content,
        public User $author, // Objet User
        public DateTime $createdAt
    ) {}

    public function addCategory(Category $category): void {
        if (!in_array($category, $this->categories, true)) {
            $this->categories[] = $category;
        }
    }
}