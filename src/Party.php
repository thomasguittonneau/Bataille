<?php 
declare(strict_types=1);

namespace Bataille;

final class Party
{
    public function __construct(
        private readonly int $numberOfCards,
        private readonly Game $game
    ) {}   

}