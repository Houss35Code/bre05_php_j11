<?php
class User {
    public ?int $id = null;

    public function __construct(
        public string $username,
        public string $email,
        public string $password,
        public string $role,
        public DateTime $createdAt
    ) {}
}