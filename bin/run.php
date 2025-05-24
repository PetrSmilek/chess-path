<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ChessPath\Model\Square;
use ChessPath\Movement\KnightMovement;
use ChessPath\Movement\BishopMovement;
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

$movementK = new KnightMovement();
$movementB = new BishopMovement();
$pathFinder = new PathFinder();

$pathK = $pathFinder->shortestPath($start, $end, $movementK);
$pathB = $pathFinder->shortestPath($start, $end, $movementB);

printPath($pathK, $start, $end, 'Knight');
printPath($pathB, $start, $end, 'Bishop');