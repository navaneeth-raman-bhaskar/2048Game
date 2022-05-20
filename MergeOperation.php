<?php

trait MergeOperation
{
    private array $temp = [];
    private array $result = [];

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

   /* private function prependTemp(int $value): void
    {
        array_unshift($this->temp, $value);
    }

    private function prependResult(int $value): void
    {
        array_unshift($this->result, $value);
    }*/

    private function shiftTemp(): int
    {
        return array_shift($this->temp);
    }

    private function shiftResult(): ?int
    {
        return array_shift($this->result);
    }

   /* private function popTemp(): int
    {
        return array_pop($this->temp);
    }

    private function popResult(): ?int
    {
        return array_pop($this->result);
    }*/

    private function isEmptyTemp(): bool
    {
        return empty($this->temp);
    }
}