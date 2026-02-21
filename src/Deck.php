<?php 
declare(strict_types=1);

namespace Bataille;

final class Deck
{
    private array $cards = [];
    public int $numberOfCards {
        get => $this->numberOfCards;
    }

    public function __construct(int $numberOfCards)
    {
        $this->numberOfCards = $numberOfCards;
        $this->cards = $this->generateDeck($numberOfCards);
    }
    
    private function generateDeck(int $numberOfCards): array
    {
        $cards = [];
        for ($i = 1; $i <= $numberOfCards; $i++) {
            $cards[] = new Card($i);
        }
        shuffle($cards);
        return $cards;
    }

    public function dealCards(int $numberOfPlayers): array
    {
        $split = (int)($this->numberOfCards / $numberOfPlayers);
        return array_chunk($this->cards, $split);
    }
} 