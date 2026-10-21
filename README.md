# Chess Path Finder

A simple PHP application to find the shortest path for chess pieces (e.g., Knight, Bishop) on a chessboard using the Breadth-First Search algorithm.

## Features

- Calculates the shortest path between two squares for different chess pieces.
- Supports movement strategies using the Strategy design pattern.
- Simple and extensible architecture.
- PHPUnit tests to verify calculation correctness.

## Installation

```bash
composer install
## Web GUI

Start the built-in PHP server and open http://localhost:8000 in a browser:

```bash
php -S localhost:8000 -t public
```

Pick a piece, click the start square and then the target square. The piece animates along the shortest path.
