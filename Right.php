<?php


class Right implements Action
{
    use \MergeOperation;

    public function handle(Board $board)
    {
        $array = $board->getBoard();
        for ($i = 0; $i < $board->getSize(); $i++) {
            for ($j = $board->getSize() - 1; $j >= 0; $j--) {
                if (isset($array[$i][$j])) {
                    $this->pushTemp($array[$i][$j]);
                }
            }
            repeat:
            if (!$this->isEmptyTemp()) {
                foreach (array_chunk($this->temp, 2) as $pair) {
                    if (count($pair) == 1) {
                        $this->pushResult($pair[0]);
                        $this->shiftTemp();
                        break;
                    }
                    if ($pair[0] == $pair[1]) {
                        $this->pushResult(2 * $pair[0]);
                        $this->shiftTemp();
                        $this->shiftTemp();
                    } else {
                        $this->pushResult($pair[0]);
                        $this->shiftTemp();
                        goto repeat;
                    }
                }
            }

            for ($j = $board->getSize() - 1; $j >= 0; $j--) {
                $board->setBoard($i, $j, $this->shiftResult());
            }

            $this->resetTemp();
            $this->resetResult();
        }
    }

    public function name(): string
    {
        return 'right';
    }
}