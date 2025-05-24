<?php

namespace ChessPath\Movement;

use ChessPath\Model\Square;

class BishopMovement implements MovementStrategy
{
    // Defines diagonal movement directions used by a bishop
    private array $directions = [
        [1, 1],
        [1, -1],
        [-1, -1],
        [-1, 1],
    ];

    public function calculateAvailableMoves(Square $from): array
    {
        $moves = [];

        foreach ($this->directions as [$dx, $dy]) {
            $x = $from->getX();
            $y = $from->getY();

            while(true) {
                $x += $dx;
                $y += $dy;

                if ($x < 0 || $x > 7 || $y < 0 || $y > 7) {
                    break; // Outside the board
                }

                $moves[] = new Square($x, $y);
            }
        }

        return $moves;
    }
}