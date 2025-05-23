<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ChessPath\Model\Square;
use ChessPath\Movement\KnightMovement;
use ChessPath\PathFinder\PathFinder;

$start = new Square(1, 0);
$end = new Square(2, 2);

$movement = new KnightMovement();
$pathFinder = new PathFinder();

$path = $pathFinder->shortestPath($start, $end, $movement);

if (empty($path)) {
    echo "No path found.\n";
} else {
    echo "Shortest path from $start to $end:\n";
    foreach ($path as $square) {
        echo $square . ' ';
    }
    echo "\n";
}