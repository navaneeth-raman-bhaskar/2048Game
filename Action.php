<?php


interface Action
{
    public function handle(Board $board);

    public function name(): string;
}