<?php

spl_autoload_register(function ($class) {
    include $class . '.php';
});

$size = readline('Enter the size of the board : ');

$board = new Board($size);
$board->show();

action:
$action = readline('Enter action 8 for up, 2 for down, 6 for right, 4 for left , 0 for stop: ');

try {
    $action = ActionFactory::action($action);
    $action->handle($board);
    echo '***** Moved to ' . $action->name().' ***** ';
    $board->show();
    goto action;
} catch (InvalidArgumentException $exception) {
    echo PHP_EOL . '***********' . $exception->getMessage() . '***********' . PHP_EOL;
    goto action;
} catch (Exception) {
    echo PHP_EOL . '***********' . 'Thanks for playing' . '***********' . PHP_EOL;
    $board->show();
    echo 'Your score is :' . $board->score();
    die();
}