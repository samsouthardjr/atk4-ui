<?php

declare(strict_types=1);

namespace Atk4\Ui\Panel;

use Atk4\Ui\Callback;
use Atk4\Ui\View;

/**
 * Slide Panel Content.
 *
 * @method Right getOwner()
 */
class Content extends View implements LoadableContent
{
    public $defaultTemplate = 'panel/content.html';

    /** @var Callback */
    public $cb;

    protected function init(): void
    {
        parent::init();

        $this->addClass('atk-panel-content');
        $this->setCb(new Callback());
    }

    /**
     * Return callback url for panel options.
     */
    public function getCallbackUrl(): string
    {
        return $this->cb->getJsUrl();
    }

    /**
     * Set callback for panel.
     */
    public function setCb(Callback $cb): void
    {
        $this->cb = $this->add($cb); // @phpstan-ignore-line
    }

    /**
     * Will load content into callback.
     */
    public function onLoad(\Closure $fx): void
    {
        $this->cb->set(function () use ($fx) {
            $fx($this);
            $this->cb->terminateJson($this);
        });
    }

    /**
     * Return an array of css selector where content will be
     * cleared on reload.
     */
    public function getClearSelector(): array
    {
        return ['.atk-panel-content'];
    }
}
