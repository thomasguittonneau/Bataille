<?php 
declare(strict_types=1);

namespace Bataille;

final class Card
{
    public int $value {
        get => $this->value;
        set => $this->validate($value);
    }

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    private function validate(int $value): int
    {
        if ($value < 1 ||$value > 52) {
            throw new \InvalidArgumentException('La valeur de la carte doit être comprise entre 1 et 52.');
        }
        return $value;
    }
}