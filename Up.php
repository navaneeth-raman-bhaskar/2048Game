<?php


class Up implements Action
{
    use \MergeOperation;

    public function handle(Board $board)
    {
        $array = $board->getBoard();
        for ($i = 0; $i < $board->getSize(); $i++) {
            for ($j = 0; $j < $board->getSize(); $j++) {
                if (isset($array[$j][$i])) {
                    $this->pushTemp($array[$j][$i]);
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

            for ($j = 0; $j < $board->getSize(); $j++) {
                $board->setBoard($j, $i, $this->shiftResult());
            }

            $this->resetTemp();
            $this->resetResult();
        }
        //throw new \ActionError();
    }

    public function name(): string
    {
        return 'up';
    }
}