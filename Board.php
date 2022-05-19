<?php

class Board
{
    private array $board = [];

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
        return (rand(1, 100) > 90 ? 4 : 2);
    }

    public function getMaxTile(): int
    {
        $max = 0;
        foreach ($this->board as $array) {
            foreach ($array as $value) {
                if ($value > $max) {
                    $max = $value;
                }
            }
        }
        return $max;
    }

    /**
     * will take too much time to find find empty index
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
        return PHP_EOL . 'Highest Tile: ' . $this->getMaxTile() . PHP_EOL . 'Total Score: ' . $this->total();
    }

    private function total(): int
    {
        return array_reduce($this->board, fn($carry, $item) => $carry + array_sum($item));
    }

    public function setBoard(array $array): void
    {
        $this->board = $array;
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