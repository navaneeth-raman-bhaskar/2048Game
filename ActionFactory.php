<?php


class ActionFactory
{
    public static function action($action): Action
    {
        return match ($action) {
            '8' => new Up(),
            '2' => new Down,
            '6' => new Right,
            '4' => new Left,
            '0' => new ExitGame(),
            default => throw new \InvalidArgumentException('Invalid action')
        };
    }
}