<?php
declare(strict_types=1);

namespace Bataille\Tests;

use Bataille\Card;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class CardTest extends TestCase
{

    public static function CardValueProvider(): array
    {
        return [
            'minimumValue' => [1, true],
            'maximumValue' => [52, true],
            'tooLowValue' => [0, false],
            'tooHighValue' => [53, false],
            'negativeValue' => [-1, false]
        ];
    }

    #[DataProvider('CardValueProvider')]
    public function testCardValueValidation(int $value, bool $isValid): void
    {
        if ($isValid) {
            $card = new Card($value);
            $this->assertSame($value, $card->value);
        } else {
            $this->expectException(\InvalidArgumentException::class);
            new Card($value);
        }
    }
}