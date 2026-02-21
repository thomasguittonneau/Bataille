# Jeu de Bataille

Un petit jeu de bataille en php

## Prérequis

- Docker
- Docker Compose

## Installation

```bash
git clone <repository>
cd bataille
docker compose up -d --build
docker compose exec app composer install
```

## Lancer le jeu

```bash
docker compose exec app php console.php
```

Le jeu vous demandera de manière interactive :
- Le nombre de joueurs (pair)
- Les noms des joueurs 
- Le nombre de cartes (pair, divisible par le nombre de joueurs)
- Le nombre de parties (impair)

## Lancer les tests

```bash
docker compose exec app ./vendor/bin/phpunit --testdox
```

## Architecture

```
src/
├── Card.php            # Entité carte (valeur 1 à N)
├── Deck.php            # Paquet de cartes, génération et distribution
├── Player.php          # Joueur, score et main
├── Party.php           # Une partie complète
├── Game.php            # Orchestrateur, config et classement
Command/
├── InputCommand.php    # Gestion de l'interaction avec le CLI
├── OutputCommand.php   # Gestion de l'interaction avec le CLI
tests/
├── CardTest.php
├── DeckTest.php
├── PlayerTest.php
├── PartyTest.php
└── GameTest.php
console.php             # Point d'entrée
```

## Règles du jeu

- Les cartes ont des valeurs de 1 à N (52 par défaut)
- Les cartes sont mélangées et distribuées équitablement entre les joueurs
- À chaque manche, chaque joueur retourne sa carte du dessus
- Le joueur avec la carte la plus forte remporte la manche (1 point)
- À la fin d'une partie, le joueur avec le plus de points gagne
- Le premier joueur à remporter la majorité du nombre de parties défini gagne le jeu

## Stack technique

- PHP 8.4
- PHPUnit 11
- Docker