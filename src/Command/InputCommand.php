<?php

declare(strict_types=1);

namespace Bataille\Command;

final class InputCommand
{
    public function askString(string $message): string
    {
        echo $message . PHP_EOL;
        return trim((string) fgets(STDIN));
    }

    public function askInt(string $message): int
    {
        echo $message . PHP_EOL;
        return (int) fgets(STDIN);
    }
}