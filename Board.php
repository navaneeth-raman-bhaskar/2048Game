<?php

class Board
{
    private array $board = [];
    private static int $score = 0;
    private static int $max = 0;

    /**
     * @throws BoardFullError
     */
    public function __construct(private int $size)
    {
        $this->setRandomTile();
    }

    public function show()
    {
        echo PHP_EOL;
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                print isset($this->board[$i][$j]) ? sprintf('%4d', ($this->board[$i][$j])) : sprintf('%4s', '-');
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

    public function generateRandomTile(): int
    {
        $random = rand(1, 100) > 90 ? 4 : 2;
        if ($this::$max < $random) {
            $this::$max = $random;
        }
        $this::$score += $random;
        return $random;
    }

    public function getMaxTile(): int
    {
        return $this::$max;
    }

    /**
     * will take too much time to find find empty index
     * @throws BoardFullError
     * @todo can be optimized the logic
     */
    public function setRandomTile(): void
    {
        if ($this->isFull()) {
            throw new \BoardFullError();
        }

        do {
            $randomIndexX = rand(0, $this->size - 1);
            $randomIndexY = rand(0, $this->size - 1);
        } while (isset($this->board[$randomIndexX][$randomIndexY]));

        $this->board[$randomIndexX][$randomIndexY] = $this->generateRandomTile();

    }

    private function isFull(): bool
    {
        $full = true;
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                if (!isset($this->board[$i][$j])) {
                    $full = false;
                    break 2;
                }
            }
        }
        return $full;
    }

    public function score(): string
    {
        return PHP_EOL . 'Highest Tile: ' . $this->getMaxTile() . PHP_EOL . 'Total Score: ' . $this::$score;
    }

    public function resetBoard(array $array): void
    {
        $this->board = $array;
    }

    public function setBoard(int $row, int $col, ?int $value): void
    {
        $this->board[$row][$col] = $value;
    }

    public function getBoard(): array
    {
        return $this->board;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function noMovesLeft(): bool
    {
        /** @todo  add logic later */
        return false;
    }
}