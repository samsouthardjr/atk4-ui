<?php

declare(strict_types=1);

namespace Atk4\Ui\Table\Column;

use Atk4\Data\Field;
use Atk4\Ui\JsSortable;
use Atk4\Ui\Table;

/**
 * Implement drag handler column for sorting table.
 */
class DragHandler extends Table\Column
{
    /** @var string */
    public $class;
    /** @var string */
    public $tag = 'i';
    /** @var JsSortable */
    public $cb;

    protected function init(): void
    {
        parent::init();

        if (!$this->class) {
            $this->class = 'content icon';
        }
        $this->cb = JsSortable::addTo($this->table, ['handleClass' => 'atk-handle']);
    }

    /**
     * Callback when table has been reorder using handle.
     */
    public function onReorder(\Closure $fx): void
    {
        $this->cb->onReorder($fx);
    }

    public function getDataCellTemplate(Field $field = null): string
    {
        return $this->getApp()->getTag($this->tag, ['class' => $this->class . ' atk-handle', 'style' => 'cursor:pointer; color: #bcbdbd']);
    }
}
