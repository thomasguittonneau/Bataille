<?php 

declare(strict_types=1);

namespace Bataille\Command;

final class OutputCommand
{
    public function writeLine(string $message): void
    {
        echo $message . PHP_EOL;
    }

    public function displayWinner(string $winnerName): void
    {
        echo "Le gagnant est : " . $winnerName . PHP_EOL;
    }

    public function displayScores(array $scores): void
    {
        echo "Scores Final :" . PHP_EOL;
        foreach ($scores as $score) {
            echo $score['player'] .' : ' .$score['score'] . " manche gagnée" . PHP_EOL;
        }
    }
}