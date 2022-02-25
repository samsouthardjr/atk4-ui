<?php

declare(strict_types=1);

namespace Atk4\Ui\Demos;

use Atk4\Ui\Button;
use Atk4\Ui\HtmlTemplate;
use Atk4\Ui\Icon;
use Atk4\Ui\Label;

/** @var \Atk4\Ui\App $app */
require_once __DIR__ . '/../init-app.php';

// Demonstrates how to use buttons.

\Atk4\Ui\Header::addTo($app, ['Basic Button', 'size' => 2]);

$form = \Atk4\Ui\Form::addTo($app);
$recipient = $form->addControl(
    'recipient',
    [\Atk4\Ui\Form\Control\Dropdown::class,
        'isMultiple' => true,
        'dropdownOptions' => ['allowAdditions' => true, 'forceSelection' => false],
    ],
    ['default' => 'Username <user@emaildomain.de>']
);
$form->onSubmit(function () use ($form) {
    echo '<pre>';
    echo htmlspecialchars(
        print_r($form->model->get(), true)
    );
});
