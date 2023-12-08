<?php

declare(strict_types=1);

namespace Geekmusclay\Algorithms\Arrays;

class Queue
{
    private array $queue;

    public function __construct(array $queue)
    {
        $this->queue = $queue;
    }

    public function top(): mixed
    {
        return end($this->queue);
    }

    public function bottom(): mixed
    {
        return $this->queue[0];
    }

    public function push(mixed $values): self
    {
        array_push($this->queue, $values);

        return $this;
    }

    public function pop(): mixed
    {
        return array_shift($this->queue);
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->queue);
    }
}
