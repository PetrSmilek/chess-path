<?php

use PHPUnit\Framework\TestCase;
use ChessPath\PathFinder\PathFinder;
use ChessPath\Model\Square;
use ChessPath\Model\Pieces\Knight;
use ChessPath\Model\Pieces\Bishop;
use ChessPath\Model\Pieces\Rook;
use ChessPath\Model\Pieces\Queen;
use ChessPath\Model\Pieces\King;

class PathFinderTest extends TestCase
{
    protected PathFinder $pathfinder;

    protected function setUp(): void
    {
        $this->pathfinder = new PathFinder();
    }

    public function testStartEqualsEnd()
    {
        $start = new Square(0, 3);
        $end = new Square(0, 3);

        $path = $this->pathfinder->shortestPath($start, $end, new Knight());

        $this->assertIsArray($path);
        $this->assertCount(1, $path);
        $this->assertEquals($start, $path[0]);
    }

    public function testKnightPathExists()
    {
        $start = new Square(7, 0);
        $end = new Square(4, 2);

        $path = $this->pathfinder->shortestPath($start, $end, new Knight());

        $this->assertCount(4, $path); // H1 -> E3 needs 3 knight moves
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }

    public function testBishopTwoMoves()
    {
        $start = new Square(0, 0);
        $end = new Square(2, 0);

        $path = $this->pathfinder->shortestPath($start, $end, new Bishop());

        $this->assertCount(3, $path);
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }


    public function testBishopCannotReachDifferentColor()
    {
        $start = new Square(1, 1);
        $end = new Square(7, 6);

        $path = $this->pathfinder->shortestPath($start, $end, new Bishop());

        $this->assertEmpty($path);
    }

    public function testBishopOneDiagonalMove()
    {
        $start = new Square(0, 0);
        $end = new Square(6, 6);

        $path = $this->pathfinder->shortestPath($start, $end, new Bishop());

        $this->assertIsArray($path);
        $this->assertCount(2, $path);
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }

    public function testRookOneMove()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(0, 7), new Rook());

        $this->assertCount(2, $path); // A1 -> A8
    }

    public function testRookTwoMoves()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(7, 7), new Rook());

        $this->assertCount(3, $path); // A1 -> H8 via a corner
    }

    public function testQueenDiagonalOneMove()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(7, 7), new Queen());

        $this->assertCount(2, $path); // A1 -> H8
    }

    public function testQueenTwoMoves()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(1, 2), new Queen());

        $this->assertCount(3, $path); // A1 -> B3 is not on a line or diagonal
    }

    public function testKingAcrossBoard()
    {
        $start = new Square(0, 0);
        $end = new Square(7, 7);

        $path = $this->pathfinder->shortestPath($start, $end, new King());

        $this->assertCount(8, $path); // 7 diagonal steps
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }
}
