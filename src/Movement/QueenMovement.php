<?php

namespace ChessPath\Movement;

class QueenMovement extends SlidingMovement
{
    // Queen combines rook and bishop directions
    protected function getDirections(): array
    {
        return [
            [1, 0], [-1, 0], [0, 1], [0, -1],
            [1, 1], [1, -1], [-1, -1], [-1, 1],
        ];
    }
}
