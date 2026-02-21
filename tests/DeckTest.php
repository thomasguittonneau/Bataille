<?php
declare(strict_types=1);

namespace Bataille\Tests;

use Bataille\Deck;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DeckTest extends TestCase
{
    public static function deckSizeEquityProvider(): array
    {
        return [
            '2players' => [52, 2, 52/2],
            '4players' => [52, 4, 52/4],
            '6players' => [48, 6, 48/6]
        ];
    }
    
    #[DataProvider('deckSizeEquityProvider')]
    public function testDeckDistributionWithEquity(int $deckSize, int $numberOfPlayers, int $expectedCardsPerPlayer): void
    {
        $deck = new Deck($deckSize);
        $playersCards = $deck->dealCards($numberOfPlayers);
        $this->assertCount($numberOfPlayers, $playersCards);
        foreach ($playersCards as $playerCards) {
            $this->assertCount($expectedCardsPerPlayer, $playerCards);
        }
    }
}