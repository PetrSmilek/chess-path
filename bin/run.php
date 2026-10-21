<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ChessPath\Model\Square;
use ChessPath\Model\Pieces\Knight;
use ChessPath\Model\Pieces\Bishop;
use ChessPath\Model\Pieces\Rook;
use ChessPath\Model\Pieces\Queen;
use ChessPath\Model\Pieces\King;
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

$pieces = [new Knight(), new Bishop(), new Rook(), new Queen(), new King()];

foreach ($pieces as $piece) {
    printPath($pathFinder->shortestPath($start, $end, $piece), $start, $end, $piece->getName());
}