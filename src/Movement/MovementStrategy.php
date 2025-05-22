<?php

namespace ChessPath\Movement;

use ChessPath\Model\Square;

interface MovementStrategy
{
    public function calculateAvailableMoves(Square $from): array; 
}