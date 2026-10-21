<?php

use PHPUnit\Framework\TestCase;
use ChessPath\Model\Square;
use ChessPath\Model\Pieces\Bishop;
use ChessPath\Model\Pieces\Knight;
use ChessPath\Model\Pieces\Rook;
use ChessPath\Model\Pieces\Queen;
use ChessPath\Model\Pieces\King;

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

    public function testRookAvailableMoves()
    {
        $rook = new Rook();

        $this->assertSame('Rook', $rook->getName());
        $this->assertCount(14, $rook->getAvailableMoves(new Square(0, 0)));
    }

    public function testQueenAvailableMoves()
    {
        $queen = new Queen();

        $this->assertSame('Queen', $queen->getName());
        $this->assertCount(21, $queen->getAvailableMoves(new Square(0, 0)));
    }

    public function testKingAvailableMoves()
    {
        $king = new King();

        $this->assertSame('King', $king->getName());
        $this->assertCount(3, $king->getAvailableMoves(new Square(0, 0)));
        $this->assertCount(8, $king->getAvailableMoves(new Square(4, 4)));
    }
}
