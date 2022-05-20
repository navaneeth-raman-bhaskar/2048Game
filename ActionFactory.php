<?php


class ActionFactory
{
    public static function make($action): Action
    {
        switch ($action) {
            case '8':
                return new Up();
            case '2':
                return new Down();
            case '6':
                return new Right();
            case '4':
                return new Left();
            case '0':
                return new ExitGame();
            default :
                throw new \InvalidArgumentException('Invalid action');
        }
    }
}