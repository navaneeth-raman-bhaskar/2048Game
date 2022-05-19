<?php


class Right implements Action
{
    use \MergeOperation;

    public function handle(Board $board)
    {
        // TODO: Implement handle() method.
    }

    public function name(): string
    {
        return 'right';
    }
}