<?php

/**
 * @package FancyTodoMaker
 */

class FancyTodoMakerActivate
{
    static public function activate()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }
}