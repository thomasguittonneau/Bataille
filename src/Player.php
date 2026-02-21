<?php
declare(strict_types=1);

namespace Bataille;

class Player
{
    private array $cards = [];

    public int $score {
        get => $this->score;
    }
    
    public string $name {
        get => $this->name;
        set => $this->validateName($value);
    }

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->score = 0;
    }

    public function addPoint(): void
    {
        $this->score++;
    }

    public function addCards(array $cards): void
    {
        $this->cards = array_merge($this->cards, $cards);
    }

    public function hasCards(): bool
    {
        return !empty($this->cards);
    }
    
    public function resetScore(): void
    {
        $this->score = 0;
    }

    public function playCard(): Card
    {
        if(!$this->hasCards()) {
            throw new \RuntimeException('Le joueur n\'a plus de cartes à jouer.');
        }   
        return array_pop($this->cards);
    }

    private function validateName(string $name): string
    {
        if (trim($name) === '') {
            throw new \InvalidArgumentException('Le nom du joueur ne peut pas être vide.');
        }
        if (strlen($name) > 50) {
            throw new \InvalidArgumentException('Le nom du joueur ne peut pas dépasser 50 caractères.');
        }
        return $name;
    }
}