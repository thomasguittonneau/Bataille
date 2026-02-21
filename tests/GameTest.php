<?php
declare(strict_types=1);

namespace Bataille\Tests;

use Bataille\Game;
use Bataille\Player;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    public static function gameConfigProvider(): array
    {
        return [
            'Game valide avec 2 joueurs'  => [1, 2,  52, true],
            'Game valide avec 2 joueurs, 2 parties' => [3, 2,  52, true],
            'Game valide avec 4 joueurs' => [1, 4,  52, true],
            'Game valide avec 6 joueurs, 2 parties' => [3, 6,  48, true],
            'Game invalide avec trop peu de cartes' => [1, 4, 3, false],
            'Game invalide sans manche' => [0, 4, 52, false],
            'Game invalide avec nombre de cartes non multiple du nombre de joueurs' => [1, 4, 51, false],
            'Game invalide avec nombre de cartes inférieur au nombre de joueurs' => [1, 4, 3, false],
            'Game invalide avec nombre de cartes non multiple du nombre de joueurs' => [1, 6, 52, false]
        ];
    }

    #[DataProvider('gameConfigProvider')]
    public function testGameConfig(int $rounds, int $numberOfPlayers, int $cards, bool $expected): void
    {
        $players = [];
        for ($i = 0; $i < $numberOfPlayers; $i++) {
            $players[] = new Player("Player" . ($i + 1));
        }

        if (!$expected) {
            $this->expectException(\InvalidArgumentException::class);
        }

        $game = new Game($rounds, $cards, $players);

        if ($expected) {
            $this->assertInstanceOf(Game::class, $game);
        }
    }

    public function testGameHasPlayers(): void
    {
        $players = [new Player("Player1"), new Player("Player2")];
        $game = new Game(1, 52, $players);
        $this->assertCount(2, $game->players);
    }

    public function testGamePlay(): void
    {
        $players = [new Player("Player1"), new Player("Player2")];
        $game = new Game(1, 52, $players);
        $game->play();
        $ranking = $game->getGameRanking();
        $this->assertCount(2, $ranking);
        $this->assertArrayHasKey('player', $ranking[0]);
        $this->assertArrayHasKey('score', $ranking[0]);
    }

    public function testResetScore(): void
    {
        $player1 = $this->createMock(Player::class);
        $player2 = $this->createMock(Player::class);
        $players = [$player1, $player2];
        $game = new Game(3, 52, $players);
        $player1->expects($this->exactly(3))->method('resetScore');
        $player2->expects($this->exactly(3))->method('resetScore');
        $game->play();
    }
}