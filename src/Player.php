<?php
declare(strict_types=1);

namespace Bataille;

final class Player
{
    public int $score {
        get => $this->score;
    }
    
    public string $name {
        get => $this->name;
        set => $this->validateName($value);
    }

    private function validateName(string $name): string
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Le nom du joueur ne peut pas être vide.');
        }
        return $name;
    }
}