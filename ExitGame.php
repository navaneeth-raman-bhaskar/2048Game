<?php


class ExitGame implements Action
{

    public function handle(Board $board): never
    {
        echo PHP_EOL . '###### ' . 'Thanks for playing' . ' ######' . PHP_EOL;
        echo 'Your score is :' . $board->score();
        die();
    }

    public function name(): string
    {
        return 'exit';
    }
}