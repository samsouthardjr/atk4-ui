<?php

declare(strict_types=1);

namespace Atk4\Ui\Tests;

use Atk4\Core\Phpunit\TestCase;
use Atk4\Ui\Paginator;

class PaginatorTest extends TestCase
{
    public function addDataProvider(): array
    {
        return [
            [1, 1, 1, [1]],
            [1, 4, 1, [1]],
            [1, 1, 2, [1, 2]],
            [1, 0, 2, [1, ']']],
            [2, 0, 3, ['[', 2, ']']],
            [1, 1, 4, [1, 2, 3, ']']],
            [1, 1, 5, [1, 2, 3, '...', ']']],
            [2, 1, 5, [1, 2, 3, '...', ']']],
            [3, 1, 5, ['[', 2, 3, 4, ']']],
            [3, 1, 6, ['[', 2, 3, 4, '...', ']']],
            [4, 1, 6, ['[', '...', 3, 4, 5, ']']],
            [5, 1, 6, ['[', '...', 4, 5, 6]],
            [6, 1, 6, ['[', '...', 4, 5, 6]],
            [7, 1, 6, ['[', '...', 4, 5, 6]],
            [6, 2, 6, ['[', 2, 3, 4, 5, 6]],
            [6, 2, 7, ['[', '...', 3, 4, 5, 6, 7]],
            [7, 2, 7, ['[', '...', 3, 4, 5, 6, 7]],
            [70, 2, 100, ['[', '...', 68, 69, 70, 71, 72, '...', ']']],
        ];
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testPaginator(int $page, int $range, int $total, array $expected): void
    {
        $p = new Paginator(['page' => $page, 'range' => $range, 'total' => $total]);
        static::assertSame($expected, $p->getPaginatorItems());
    }
}
