<?php

namespace ChessPath\Movement;

class RookMovement extends SlidingMovement
{
    // Defines horizontal and vertical movement directions used by a rook
    protected function getDirections(): array
    {
        return [
            [1, 0],
            [-1, 0],
            [0, 1],
            [0, -1],
        ];
    }
}
