<?php

class Character 
{
    protected int $life;
    protected string $name;

    public function __construct() {}

    public function getLife(): int { return $this->life; }
    public function setLife(int $life): void { $this->life = $life; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    // SOLUTION RADICALE : Passage en public
    public function introduce(): string 
    {
        return "Bonjour je m'appelle " . $this->name;
    }
}

/*
Le problème avec Character :
La solution radicale : Passer la méthode introduce() en public dans la classe Character pour qu'elle soit accessible partout.
*/