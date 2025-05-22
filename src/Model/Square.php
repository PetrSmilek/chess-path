<?php

namespace ChessPath\Model;

class Square {
    private int $x; // 0-7 (columns A-H)
    private int $y; // 0-7 (rows 1-8)

    public function __construct(int $x, int $y)
    {
        if ($x < 0 || $x > 7 || $y < 0 || $y > 7) {
            throw new \InvalidArgumentException("Square out of bounds: ($x, $y)");
        }

        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getColor(): string
    {
        return ($this->x + $this->y) % 2 === 0 ? 'black' : 'white';
    }

    public function equals(Square $other): bool
    {
        return $this->x === $other->x && $this->y === $other->y;
    }

    public function __toString(): string
    {
        $col = chr($this->x + ord('A'));
        $row = $this->y + 1;
        return $col . $row;
    }
}