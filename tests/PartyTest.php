<?php
declare(strict_types=1);

namespace Bataille\Tests;

use Bataille\Party;
use Bataille\Game;
use Bataille\Player;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PartyTest extends TestCase
{
    public function testPartyCanBePlayed(): void
    {        
        $players = [new Player('Player1'), new Player('Player2')];
        $game = new Game(1, 52, $players);
        $party = new Party($game);
        $this->assertInstanceOf(Party::class, $party);
        $party->play();
        $winner = $party->getWinner();
        $this->assertInstanceOf(Player::class, $winner);
    }
}