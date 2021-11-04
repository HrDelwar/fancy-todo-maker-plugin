<?php

/**
 * @package FancyTodoMaker
 */

class FancyTodoMakerDeactivation
{
    static public function deactivate()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }
}