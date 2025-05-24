<?php

namespace ChessPath\Pathfinder;

use ChessPath\Model\Square;
use ChessPath\Movement\MovementStrategy;

class PathFinder
{
    /**
     * Calculates the shortest path between two squares based on the given movement strategy
     * Uses breadth-first search (BFS) to find the shortest sequence of legal moves
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

    /**
     * Reconstructs the path from end square to start using the predecessor map
     *
     * @param Square $start Starting square
     * @param Square $end Destination square
     * @param array<string, Square> $predecessor Map of positions to their preceding squares
     * @return Square[] Ordered array representing the path from start to end
     */
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

    /**
     * Generates a unique hash string for a square based on its coordinates
     *
     * @param Square $square
     * @return string
     */
    private function hash(Square $square): string
    {
        return $square->getX() . ',' . $square->getY();
    }
}