<?php
declare(strict_types=1);

namespace Bataille;

final Class Game
{
    public int $numberOfParty {
        get => $this->numberOfParty;
        set => $this->validateNumberOfParty($numberOfParty);
    }

    public int $numberOfCards {
        get => $this->numberOfCards;
        set => $this->validateNumberOfCards($numberOfCards);
    }

    public int $numberOfPlayers {
        get => $this->numberOfPlayers;
        set => $this->validateNumberOfPlayers($numberOfPlayers);
    }

    public function __construct(int $numberOfParty, int $numberOfCards, int $numberOfPlayers)
    {
        $this->numberOfParty = $numberOfParty;
        $this->numberOfCards = $numberOfCards;
        $this->numberOfPlayers = $numberOfPlayers;
    }

    private function validateNumberOfParty(int $value): int
    {
        if ($value < 1) {
            throw new \InvalidArgumentException('Le nombre de parties doit être au moins de 1.');
        }
        if ($value %2 === 0) {
            throw new \InvalidArgumentException('Le nombre de parties doit être impair pour éviter les égalités.');
        }
        return $value;
    }
    
    private function validateNumberOfCards(int $value): int
    {
        if ($value < 1 || $value % 2 !== 0) {
            throw new \InvalidArgumentException('Le nombre de cartes doit être au moins de 1 et pair.');
        }
        return $value;
    }
    
    private function validateNumberOfPlayers(int $value): int
    {
        if ($value < 1 || $value % 2 !== 0) {
            throw new \InvalidArgumentException('Le nombre de joueurs doit être au moins de 1 et pair.');
        }
        return $value;
    }

}