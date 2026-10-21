<?php

use PHPUnit\Framework\TestCase;
use ChessPath\Model\Square;
use ChessPath\Model\Pieces\Bishop;
use ChessPath\Model\Pieces\Knight;

class PieceTest extends TestCase
{
    public function testBishopAvailableMoves()
    {
        $bishop = new Bishop();

        $this->assertSame('Bishop', $bishop->getName());
        $this->assertCount(7, $bishop->getAvailableMoves(new Square(0, 0)));
    }

    public function testKnightAvailableMoves()
    {
        $knight = new Knight();

        $this->assertSame('Knight', $knight->getName());
        $this->assertCount(2, $knight->getAvailableMoves(new Square(0, 0)));
    }
}
