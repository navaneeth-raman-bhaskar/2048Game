<?php

trait MergeOperation
{
    private array $temp = [];
    private array $result = [];
    private bool $success = true;

    private function resetTemp(): void
    {
        $this->temp = [];
    }

    private function resetResult(): void
    {
        $this->temp = [];
    }

    private function pushTemp(int $value): void
    {
        $this->temp[] = $value;
    }

    private function pushResult(int $value): void
    {
        $this->result[] = $value;
    }

    private function shiftTemp(): int
    {
        return array_shift($this->temp);
    }

    private function shiftResult(): ?int
    {
        return array_shift($this->result);
    }

    private function isEmptyTemp(): bool
    {
        return empty($this->temp);
    }

    /**
     * @throws ActionError
     */
    private function check(array $array, Board $board): void
    {
        $this->success = false;
        foreach ($array as $key => $rows) {
            if (array_filter($rows) != array_filter($board->getBoard()[$key])) {
                $this->success = true;
                break;
            }
        }
        if (!$this->getSuccessFlag()) {
            throw new \ActionError('Cannot Moved to ' . $this->name());
        }
    }

    public function getSuccessFlag(): bool
    {
        return $this->success;
    }
}