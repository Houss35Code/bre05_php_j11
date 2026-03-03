<?php
class Category {
    public ?int $id = null;
    public array $posts = [];

    public function __construct(
        public string $title,
        public string $description
    ) {}

    public function addPost(Post $post): void {
        if (!in_array($post, $this->posts, true)) {
            $this->posts[] = $post;
        }
    }
}