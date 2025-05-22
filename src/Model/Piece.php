<?php

namespace ChessPath\Model;

use ChessPath\Model\Square;

interface Piece
{
    public function getAvailableMoves(Square $from): array;

    public function getName(): string;
}