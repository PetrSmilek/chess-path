<?php

namespace ChessPath\Movement;

use ChessPath\Model\Square;

class KingMovement implements MovementStrategy
{
    // Defines one-square movement in all eight directions
    private array $moveOffsets = [
        [1, 0], [1, 1], [0, 1], [-1, 1],
        [-1, 0], [-1, -1], [0, -1], [1, -1]
    ];

    public function calculateAvailableMoves(Square $from): array
    {
        $moves = [];

        foreach ($this->moveOffsets as [$dx, $dy]) {
            $newX = $from->getX() + $dx;
            $newY = $from->getY() + $dy;

            if ($newX >= 0 && $newX < 8 && $newY >= 0 && $newY < 8) {
                $moves[] = new Square($newX, $newY);
            }
        }

        return $moves;
    }
}
