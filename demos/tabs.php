<?php
/**
 * Demonstrates how to use tabs.
 */
require 'init.php';

$t = $layout->add('Tabs');

// static tab
$t->addTab('Hello')->add('HelloWorld');
$t->addTab('Static Tab')->add('LoremIpsum');

// dynamic tab
$t->addTab('Dynamically Loading', function ($tab) {
    $tab->add(['LoremIpsum', 'size'=>2]);
});
