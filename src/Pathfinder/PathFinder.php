<?php

namespace ChessPath\Pathfinding;

use ChessPath\Model\Square;
use ChessPath\Movement\MovementStrategy;

class PathFinder
{
    /**
     * @param Square $start
     * @param Square $end
     * @param MovementStrategy $movementStrategy
     * @return Square[] Array of squares representing the shortest path
     */
    public function shortestPath(Square $start, Square $end, MovementStrategy $movementStrategy): array
    {
        // TODO: implementace BFS
    }
}