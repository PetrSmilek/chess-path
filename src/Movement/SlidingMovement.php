<?php

namespace ChessPath\Movement;

use ChessPath\Model\Square;

/**
 * Base class for pieces that slide any number of squares in given directions
 * (bishop, rook, queen)
 */
abstract class SlidingMovement implements MovementStrategy
{
    /**
     * @return array<array{int, int}> Movement directions as [dx, dy] pairs
     */
    abstract protected function getDirections(): array;

    public function calculateAvailableMoves(Square $from): array
    {
        $moves = [];

        foreach ($this->getDirections() as [$dx, $dy]) {
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
