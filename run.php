<?php

spl_autoload_register(function ($class) {
    include $class . '.php';
});

size:
$size = readline('Enter the size of the board : ');
if ($size <= 0) {
    echo PHP_EOL . '*********** ' . 'Enter a natural number' . ' ***** Try Again ******' . PHP_EOL;
    goto size;
}

$board = new Board($size);
$board->show();

action:
$action = readline('Enter action 8 for up, 2 for down, 6 for right, 4 for left , 0 for stop: ');

try {
    $action = ActionFactory::make($action);
    $action->handle($board);
    $board->setRandomTile();
    echo '----- Moved to ' . $action->name() . ' -----' . PHP_EOL;
    $board->show();
    if ($board->getMaxTile() == 2048) {
        echo '----- ' . 'You won!' . ' -----' . PHP_EOL;
    }
    goto action;
} catch (InvalidArgumentException $exception) {
    echo PHP_EOL . '*********** ' . $exception->getMessage() . ' ***** Try Again ******' . PHP_EOL;
    goto action;
} catch (ActionError $exception) {
    echo PHP_EOL . '*********** ' . $exception->getMessage() . '*** Try Other **' . PHP_EOL;
    goto action;
} catch (BoardFullError $exception) {
    echo PHP_EOL . '###### ' . 'No Moves Left. Game Over' . ' ######' . PHP_EOL;
    echo 'Your score:' . $board->score();
    die();
}