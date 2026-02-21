<?php
declare(strict_types=1);

namespace Bataille\Tests;

use Bataille\Card;
use Bataille\Player;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PlayerTest extends TestCase
{
    public static function PlayerNameProvider(): array
    {
        return [
            'validName' => ['Player1', true],
            'emptyName' => ['', false],
            'spaceOnlyName' => ['   ', false],
            'tooLongName' => ['abcdefghijklmonpqrstuvwxyzabcdefghijkmonpqrstuvwxyz', false]
        ];
    }

    #[DataProvider('PlayerNameProvider')]
    public function testPlayerNameValidation(string $name, bool $isValid): void
    {
        if ($isValid) {
            $player = new Player($name);
            $this->assertSame($name, $player->name);    
        } else {
            $this->expectException(\InvalidArgumentException::class);
            new Player($name);
        }
    }

    public function testPlayerAddPointTest(): void
    {
        $player = new Player('PlayerScore');
        $this->assertSame(0, $player->score);
        $player->addPoint();
        $this->assertSame(1, $player->score);
        $player->addPoint();
        $player->addPoint();
        $this->assertSame(3, $player->score);
    }
    
    public function testPlayerHasCardsTest(): void
    {
        $player = new Player('PlayerCards');
        $this->assertFalse($player->hasCards());
        $player->addCards([new Card(1), new Card(2)]);
        $this->assertTrue($player->hasCards());
    }

    public function testPlayerPlayWithoutCards(): void
    {
        $player = new Player('PlayerCards');
        $this->expectException(\RuntimeException::class);
        $player->playCard();
    }

    public function testPlayerPlayWithCards(): void
    {
        $player = new Player('PlayerCards');
        $player->addCards([new Card(1), new Card(2)]);
        $player->playCard();
        $this->assertTrue($player->hasCards());
        $player->playCard();
        $this->assertFalse($player->hasCards());
    }




}