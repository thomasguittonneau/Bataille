<?php
declare(strict_types=1);

namespace Bataille;

final Class Game
{
    public int $numberOfParty {
        get => $this->numberOfParty;
        set => $this->validateNumberOfParty($value);
    }

    public int $numberOfCards {
        get => $this->numberOfCards;
        set => $this->validateNumberOfCards($value);
    }

    public array $players {
        get => $this->players;
    }

    private array $gameRanking;

    public function __construct(int $numberOfParty, int $numberOfCards, array $players)
    {
        $this->numberOfParty = $numberOfParty;
        $this->players = $players;
        $this->numberOfCards = $numberOfCards;
        $this->gameRanking = [];
        $this->initGameRanking();
    }

    public function play(): Game
    {
        for ($i = 0; $i < $this->numberOfParty; $i++) {
            $party = new Party($this);
            $party->play();
            $winner = $party->getWinner();
            $this->gameRanking[array_search($winner, $this->players)]['score']++;
        }
        usort($this->gameRanking, fn($a, $b) => $b['score'] <=> $a['score']);
        return $this;
    }

    public function getGameRanking(): array
    {
        return $this->gameRanking;
    }

    private function initGameRanking(): void
    {
        foreach ($this->players as $player) {
            $this->gameRanking[] = ['player' => $player->name, 'score' => 0];
        }
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
        $countPlayers = count($this->players);
        if ($value < $countPlayers) {
            throw new \InvalidArgumentException('Le nombre de cartes doit être au moins égal au nombre de joueurs');
        }
        if ($value % $countPlayers !== 0 ) {
            throw new \InvalidArgumentException('Le nombre de cartes doit être un multiple du nombre de joueurs.');
        }
        return $value;
    }

}