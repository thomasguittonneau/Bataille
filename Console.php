<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Bataille\Command\InputCommand;
use Bataille\Command\OutputCommand;

$input = new InputCommand();
$output = new OutputCommand();

$output->writeLine("Bienvenue dans le jeu de la bataille !");
$nbPlayers = $input->askInt("Nombre de joueurs (2-4-6) : ");
$nbCards = $input->askInt("Nombre de cartes (Nombre pair) : ");
$nbParty = $input->askInt("Nombre de parties : ");

$players = [];
for ($i = 0; $i < $nbPlayers; $i++) {
    $name = $input->askString("Nom du joueur " . ($i + 1) . " : ");
    $players[] = new Bataille\Player($name);
}

$game = new Bataille\Game($nbParty, $nbCards, $players);
$game->play();

$output->displayScores($game->getGameRanking());
$output->displayWinner($game->getGameRanking()[0]['player']);

