<?php

namespace ChessPath\Movement;

use ChessPath\Model\Square;

class KnightMovement implements MovementStrategy
{
    // Defines the unique L-shaped movement pattern specific to the knight
    private array $moveOffsets = [
        [1, 2], [2, 1], [2, -1], [1, -2],
        [-1, -2], [-2, -1], [-2, 1], [-1, 2]
    ];

    public function getAvailableMoves(Square $from): array
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