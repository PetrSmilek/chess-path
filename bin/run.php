<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ChessPath\Model\Square;
use ChessPath\Movement\KnightMovement;
use ChessPath\Movement\BishopMovement;
use ChessPath\Movement\RookMovement;
use ChessPath\Movement\QueenMovement;
use ChessPath\Movement\KingMovement;
use ChessPath\PathFinder\PathFinder;

function printPath(array $path, Square $start, Square $end, string $pieceName): void {
    if (empty($path)) {
        echo "No path found for $pieceName." . PHP_EOL;
        return;
    }
    echo "Shortest path for $pieceName from $start to $end:" . PHP_EOL;
    foreach ($path as $square) {
        echo $square . ' ';
    }
    echo PHP_EOL;
}

$start = new Square(1, 2);
$end = new Square(3, 4);

$pathFinder = new PathFinder();

$movements = [
    'Knight' => new KnightMovement(),
    'Bishop' => new BishopMovement(),
    'Rook' => new RookMovement(),
    'Queen' => new QueenMovement(),
    'King' => new KingMovement(),
];

foreach ($movements as $pieceName => $movement) {
    printPath($pathFinder->shortestPath($start, $end, $movement), $start, $end, $pieceName);
}