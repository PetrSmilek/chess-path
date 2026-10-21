<?php

namespace ChessPath\Movement;

class BishopMovement extends SlidingMovement
{
    // Defines diagonal movement directions used by a bishop
    protected function getDirections(): array
    {
        return [
            [1, 1],
            [1, -1],
            [-1, -1],
            [-1, 1],
        ];
    }
}
