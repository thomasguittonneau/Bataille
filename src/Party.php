<?php 
declare(strict_types=1);

namespace Bataille;

final class Party
{
    private ?Player $winner = null;

    public function __construct(private readonly Game $game) {}

    public function play(): void
    {
        $deck = new Deck($this->game->numberOfCards);
        $players = $this->game->players;
        $deckPack = $deck->dealCards(count($players));

        foreach ($players as $player) {
            $player->addCards(array_pop($deckPack));
        }

        while ($players[0]->hasCards()) {
            $this->resolveRound($players);
        }
        $this->resolveWinner($players);
    }

    private function resolveRound(array $players): void
    {
        $highestCardValue = -1;
        $winner = null;
        foreach ($players as $player) {
            $card = $player->playCard();
            if ($card->value > $highestCardValue) {
                $highestCardValue = $card->value;
                $winner = $player;
            }
        }
        $winner->addPoint();
    }

    private function resolveWinner(array $players): void
    {
        $winner = $players[0];
        foreach ($players as $player) {
            if ($player->score > $winner->score) {
                $winner = $player;
            }
        }
        $this->winner = $winner;
    }

    public function getWinner(): ?Player
    {
        return $this->winner;
    }


}