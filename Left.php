<?php


class Left implements Action
{
    use \MergeOperation;

    public function handle(Board $board)
    {
        // TODO: Implement handle() method.
    }

    public function name(): string
    {
        return 'left';
    }
}