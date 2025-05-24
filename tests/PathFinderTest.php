<?php

use PHPUnit\Framework\TestCase;
use ChessPath\PathFinder\PathFinder;
use ChessPath\Model\Square;
use ChessPath\Movement\KnightMovement;
use ChessPath\Movement\BishopMovement;

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

        $this->assertNotEmpty($path);
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
}