<?php

namespace ChessPath\Model\Pieces;

use ChessPath\Model\Square;
use ChessPath\Model\Piece;
use ChessPath\Movement\MovementStrategy;
use ChessPath\Movement\BishopMovement;

class Bishop implements Piece
{
    private MovementStrategy $movementStrategy;

    public function __construct()
    {
        $this->movementStrtegy = new BishopMovement();
    }

    public function getAvailableMoves(Square $from): array
    {
        return $this->movementStrategy->calculateAvailableMoves($from);
    }

    public function getName(): string
    {
        return 'Bishop';
    }
}