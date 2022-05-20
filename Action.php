<?php

interface Action
{
    /** @throws \ActionError */
    public function handle(Board $board);

    public function name(): string;
}