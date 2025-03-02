<?php

declare(strict_types=1);

namespace Atk4\Ui\Demos;

use Atk4\Ui\Button;
use Atk4\Ui\Console;
use Atk4\Ui\Header;
use Atk4\Ui\JsReload;
use Atk4\Ui\JsToast;
use Atk4\Ui\Label;
use Atk4\Ui\Loader;
use Atk4\Ui\Table;
use Atk4\Ui\View;

/** @var \Atk4\Ui\App $app */
require_once __DIR__ . '/../init-app.php';

// This demo shows a local impact of a sticky parameters.

if (isset($_GET['name'])) {
    // IMPORTANT: because this is an optional frame, I have to specify it's unique shortName explicitly, othrewise
    // the name for a second frame will be affected by presence of GET['name'] parameter
    $frame = View::addTo($app, ['ui' => 'red segment', 'shortName' => 'fr1']);
    $frame->stickyGet('name');

    // frame will generate URL with sticky parameter
    Label::addTo($frame, ['Name:', 'detail' => $_GET['name'], 'class.black' => true])->link($frame->url());

    // app still generates URL without localized sticky
    Label::addTo($frame, ['Reset', 'iconRight' => 'close', 'class.black' => true])->link($app->url());
    View::addTo($frame, ['ui' => 'hidden divider']);

    // nested interractive elemetns will respect lockal sticky get
    Button::addTo($frame, ['Triggering callback here will inherit color'])->on('click', function () {
        return new JsToast('Color was = ' . $_GET['name']);
    });

    // Next we have loader, which will dynamically load console which will dynamically output "success" message.
    Loader::addTo($frame)->set(function (Loader $p) {
        Console::addTo($p)->set(function (Console $console) {
            $console->output('success!, color is still ' . $_GET['name']);
        });
    });
}

$t = Table::addTo($app);
$t->setSource(['Red', 'Green', 'Blue']);
$t->addDecorator('name', [Table\Column\Link::class, [], ['name']]);

$frame = View::addTo($app, ['ui' => 'green segment']);
Button::addTo($frame, ['does not inherit sticky get'])->on('click', function () use ($app) {
    return new JsToast('$_GET = ' . $app->encodeJson($_GET));
});

Header::addTo($app, ['Use of View::url()']);

$b1 = Button::addTo($app);
$b1->set($b1->url());

Loader::addTo($app)->set(function (Loader $p) use ($b1) {
    $b2 = Button::addTo($p);
    $b2->set($b2->url());

    $b2->on('click', new JsReload($b1));
});

$b3 = Button::addTo($app);
$b3->set($b3->url());
