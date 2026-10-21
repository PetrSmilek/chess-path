<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ChessPath\Model\Square;
use ChessPath\Model\Pieces\Knight;
use ChessPath\Model\Pieces\Bishop;
use ChessPath\Model\Pieces\Rook;
use ChessPath\Model\Pieces\Queen;
use ChessPath\Model\Pieces\King;
use ChessPath\PathFinder\PathFinder;

header('Content-Type: application/json');

$pieces = [
    'knight' => new Knight(),
    'bishop' => new Bishop(),
    'rook' => new Rook(),
    'queen' => new Queen(),
    'king' => new King(),
];

// Converts notation like "B3" to a Square
function parseSquare(string $notation): Square
{
    if (!preg_match('/^([A-H])([1-8])$/i', $notation, $m)) {
        throw new \InvalidArgumentException("Invalid square: $notation");
    }

    return new Square(ord(strtoupper($m[1])) - ord('A'), (int) $m[2] - 1);
}

try {
    $piece = $_GET['piece'] ?? '';
    if (!isset($pieces[$piece])) {
        throw new \InvalidArgumentException("Unknown piece: $piece");
    }

    $from = parseSquare($_GET['from'] ?? '');
    $to = parseSquare($_GET['to'] ?? '');

    $path = (new PathFinder())->shortestPath($from, $to, $pieces[$piece]);

    echo json_encode(['path' => array_map('strval', $path)]);
} catch (\InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
