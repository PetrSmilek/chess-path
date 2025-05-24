<?php

namespace ChessPath\Pathfinder;

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
        if ($start->equals($end)) {
            return [$start];
        }

        $queue = new \SplQueue();
        $visited = [];
        $predecessor = [];

        $queue->enqueue($start);
        $visited[$this->hash($start)] = true;

        while (!$queue->isEmpty()) {
            $current = $queue->dequeue();

            foreach ($movementStrategy->calculateAvailableMoves($current) as $neighbor) {
                $hash = $this->hash($neighbor);
                if (!isset($visited[$hash])) {
                    $visited[$hash] = true;
                    $predecessor[$hash] = $current;
                    if ($neighbor->equals($end)) {
                        return $this->reconstructPath($start, $end, $predecessor);
                    }
                    $queue->enqueue($neighbor);
                }
            }
        }

        return []; // Path does not exist
    }

    private function reconstructPath(Square $start, Square $end, array $predecessor): array
    {
        $path = [$end];
        $current = $end;

        while (!$current->equals($start)) {
            $current = $predecessor[$this->hash($current)];
            array_unshift($path, $current);
        }

        return $path;
    }

    private function hash(Square $square): string
    {
        return $square->getX() . ',' . $square->getY();
    }
}