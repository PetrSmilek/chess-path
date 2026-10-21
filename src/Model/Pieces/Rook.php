<?php

namespace ChessPath\Model\Pieces;

use ChessPath\Model\Square;
use ChessPath\Model\Piece;
use ChessPath\Movement\MovementStrategy;
use ChessPath\Movement\RookMovement;

class Rook implements Piece
{
    private MovementStrategy $movementStrategy;

    public function __construct()
    {
        $this->movementStrategy = new RookMovement();
    }

    public function getAvailableMoves(Square $from): array
    {
        return $this->movementStrategy->calculateAvailableMoves($from);
    }

    public function getName(): string
    {
        return 'Rook';
    }
}