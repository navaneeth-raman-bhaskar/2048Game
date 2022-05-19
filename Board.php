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
        $max = (int)log($this->getMaxTile(), 2);
        return 2 ** rand(1, $max ?: 1);
    }

    private function getMaxTile(): int
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
     * @todo can be ptimized the logic
     */
    public function setRandomTile(): void
    {
        if ($this->isFull()) {
            return; //cant insert new tile for now
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
        return PHP_EOL.'Max Tile: '.$this->getMaxTile() . PHP_EOL . 'Total Score: '.$this->total();
    }

    private function total(): int
    {
        return array_reduce($this->board, fn($carry, $item) => array_sum($item));
    }
}