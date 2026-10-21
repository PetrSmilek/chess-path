<?php

use PHPUnit\Framework\TestCase;
use ChessPath\PathFinder\PathFinder;
use ChessPath\Model\Square;
use ChessPath\Movement\KnightMovement;
use ChessPath\Movement\BishopMovement;
use ChessPath\Movement\RookMovement;
use ChessPath\Movement\QueenMovement;
use ChessPath\Movement\KingMovement;

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

        $path = $this->pathfinder->shortestPath($start, $end, new KnightMovement());

        $this->assertIsArray($path);
        $this->assertCount(1, $path);
        $this->assertEquals($start, $path[0]);
    }

    public function testKnightPathExists()
    {
        $start = new Square(7, 0);
        $end = new Square(4, 2);

        $path = $this->pathfinder->shortestPath($start, $end, new KnightMovement());

        $this->assertCount(4, $path); // H1 -> E3 needs 3 knight moves
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }

    public function testBishopTwoMoves()
    {
        $start = new Square(0, 0);
        $end = new Square(2, 0);

        $path = $this->pathfinder->shortestPath($start, $end, new BishopMovement());

        $this->assertCount(3, $path);
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }


    public function testBishopCannotReachDifferentColor()
    {
        $start = new Square(1, 1);
        $end = new Square(7, 6);

        $path = $this->pathfinder->shortestPath($start, $end, new BishopMovement());

        $this->assertEmpty($path);
    }

    public function testBishopOneDiagonalMove()
    {
        $start = new Square(0, 0);
        $end = new Square(6, 6);

        $path = $this->pathfinder->shortestPath($start, $end, new BishopMovement());

        $this->assertIsArray($path);
        $this->assertCount(2, $path);
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }

    public function testRookOneMove()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(0, 7), new RookMovement());

        $this->assertCount(2, $path); // A1 -> A8
    }

    public function testRookTwoMoves()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(7, 7), new RookMovement());

        $this->assertCount(3, $path); // A1 -> H8 via a corner
    }

    public function testQueenDiagonalOneMove()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(7, 7), new QueenMovement());

        $this->assertCount(2, $path); // A1 -> H8
    }

    public function testQueenTwoMoves()
    {
        $path = $this->pathfinder->shortestPath(new Square(0, 0), new Square(1, 2), new QueenMovement());

        $this->assertCount(3, $path); // A1 -> B3 is not on a line or diagonal
    }

    public function testKingAcrossBoard()
    {
        $start = new Square(0, 0);
        $end = new Square(7, 7);

        $path = $this->pathfinder->shortestPath($start, $end, new KingMovement());

        $this->assertCount(8, $path); // 7 diagonal steps
        $this->assertEquals($start, $path[0]);
        $this->assertEquals($end, end($path));
    }
}
